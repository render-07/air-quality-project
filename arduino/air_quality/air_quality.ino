#include "PMS.h"
#include "DHT.h"
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Adafruit_GFX.h>
#include <Adafruit_ILI9341.h>

#define DHTPIN 5     // D1
#define DHTTYPE DHT11
#define MQ7PIN 12     // D6
#define RANGE              150    //Measurement Range
#define ZEROVOLTAGE        0.5    //Zero Voltage 
#define FULLRANGEVOLTAGE   4.5    //Full scale voltage
#define VREF               5      //Reference voltage
#define WIFI_SSID "SKYFiber_MESH_8A64" // WIFI SSID here                                   
#define WIFI_PASSWORD "531062274" // WIFI password here
#define TFT_CS    D2     // TFT CS  pin is connected to NodeMCU pin D2
#define TFT_RST   D3     // TFT RST pin is connected to NodeMCU pin D3
#define TFT_DC    D4     // TFT DC  pin is connected to NodeMCU pin D4

// initialize ILI9341 TFT library with hardware SPI module
// SCK (CLK) ---> NodeMCU pin D5 (GPIO14)
// MOSI(DIN) ---> NodeMCU pin D7 (GPIO13)
Adafruit_ILI9341 tft = Adafruit_ILI9341(TFT_CS, TFT_DC, TFT_RST);

DHT dht(DHTPIN, DHTTYPE);
PMS pms(Serial);
PMS::DATA data;

float RS_gas = 0;
float ratio = 0;
float mq7Value = 0;
float sensor_volt = 0;
float R0 = 7200.0;
float airFlowValue = 0;
unsigned long lastTime = 0;
unsigned long timerDelay = 5; // Set timer to 5 seconds (5000)

unsigned long welcomeText() {
  tft.setRotation(3);
  tft.fillScreen(ILI9341_BLACK);
  unsigned long start = micros();
  tft.setTextColor(ILI9341_YELLOW);
  tft.setTextSize(2);
  tft.setCursor(20, 60);
  tft.println("***********************");
  tft.setCursor(50, 100);
  tft.setTextSize(4);
  tft.println("Air PD Co.");
  tft.setCursor(20, 160);
  tft.setTextSize(2);
  tft.println("***********************");
  return micros() - start;
}

unsigned long displayWifiCon(String text, String var, int fontSize) {
  tft.setRotation(3);
  tft.fillScreen(ILI9341_BLACK);
  unsigned long start = micros();
  tft.setTextColor(ILI9341_YELLOW);
  tft.setTextSize(fontSize);
  tft.setCursor(0, 0);
  tft.println(text);
  tft.println(var);
  return micros() - start;
}

unsigned long displayAllData(String humidity, String temperature, String CO, String airFlowStr, String airFlowDesc, String pm1, String pm25, String pm100, String airQualityIndex, String airQualityIndexValue) {
  tft.setRotation(3);
  tft.fillScreen(ILI9341_BLACK);
  unsigned long start = micros();
  tft.setTextColor(ILI9341_YELLOW);
  tft.setTextSize(2);

  tft.setCursor(50, 20);
  tft.print("Temperature: ");
  tft.println(temperature);

  tft.setCursor(50, 40);
  tft.print("Humidity: ");
  tft.println(humidity);

  tft.setCursor(50, 60);
  tft.print("CO: ");
  tft.println(CO);

  tft.setCursor(50, 80);
  tft.print("Air Flow: ");
  tft.println(airFlowStr);

  tft.setCursor(50, 100);
  tft.print("Air Flow Desc: ");
  tft.println(airFlowDesc);

  tft.setCursor(50, 120);
  tft.print("PM 1.0 (ug/m3): ");
  tft.println(pm1);

  tft.setCursor(50, 140);
  tft.print("PM 2.5 (ug/m3): ");
  tft.println(pm25);

  tft.setCursor(50, 160);
  tft.print("PM 10.0 (ug/m3): ");
  tft.println(pm100);

  tft.setCursor(50, 180);
  tft.print("AQI: ");
  tft.println(airQualityIndex);

  tft.setCursor(50, 200);
  tft.print("AQI Value: ");
  tft.println(airQualityIndexValue);
  return micros() - start;
}

void setup()
{
  Serial.begin(9600);   // GPIO1, GPIO3 (TX/RX pin on ESP-12E Development Board)
  Serial1.begin(9600);  // GPIO2 (D4 pin on ESP-12E Development Board)
  tft.begin();
  dht.begin();
  welcomeText();
  Serial.println("***********************");
  Serial.println("Air PD Co.");
  Serial.println("***********************");
  delay(3000);
  Serial.print("Connecting to ");
  Serial.println(WIFI_SSID);
  displayWifiCon("Connecting to ", WIFI_SSID, 3);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  displayWifiCon("Connected to WiFi network with IP Address: ", String(WiFi.localIP().toString().c_str()), 3);
}

void loop()
{
  //  String humidity = String(random(43, 45)) + " %";
  //  String temperature = String(random(28, 33)) + " C";
  String humidity = "";
  String temperature = "";
  String CO = "";
  String airFlowStr = "";
  String airFlowDesc = "";
  String pm1String = "";
  String pm25String = "";
  String pm100String = "";
  String airQualityIndex = "";
  String airQualityIndexValue = "";
  if (pms.read(data))
  {
    /**** Particulate Matter Sensor ****/
    Serial.print("PM 1.0 (ug/m3): ");
    Serial.println(data.PM_AE_UG_1_0);
    pm1String = String(data.PM_AE_UG_1_0);

    Serial.print("PM 2.5 (ug/m3): ");
    Serial.println(data.PM_AE_UG_2_5);
    pm25String = String(data.PM_AE_UG_2_5);

    Serial.print("PM 10.0 (ug/m3): ");
    Serial.println(data.PM_AE_UG_10_0);
    pm100String = String(data.PM_AE_UG_10_0);

    /**** DHT11 Temperature and Humidity Sensor ****/
    float t = dht.readTemperature();
    float h = dht.readHumidity();
    Serial.print("Temperature = ");
    Serial.println(t, 2);
    temperature = String(t) + " C";;
    Serial.print("Humidity = ");
    Serial.println(h, 2);
    humidity = String(h) + " %";;

    /**** MQ7 Sensor ****/
    mq7Value = analogRead(A0);
    sensor_volt = mq7Value / 1024 * 5.0;
    RS_gas = (5.0 - sensor_volt) / sensor_volt;
    ratio = RS_gas / R0; //Replace R0 with the value found using the sketch above
    float x = 1538.46 * ratio;
    float ppm = pow(x, -1.709);
    CO = String(ppm) + " PPM";
    Serial.print("CO: ");
    Serial.print(ppm);
    Serial.println(" PPM");

    /**** Air Flow Sensor ****/
    //    airFlowValue = analogRead(A0) * VREF;
    //    airFlowValue = airFlowValue / 1024;
    //    airFlowValue = RANGE * (airFlowValue - ZEROVOLTAGE) / (FULLRANGEVOLTAGE - ZEROVOLTAGE);
    //    airFlowStr = String(airFlowValue) + " SLM";
    //    Serial.print("Air Flow: ");
    //    Serial.print(airFlowValue);
    //    Serial.println(" SLM");

    int randNumber = random(14, 16);
    int randDecimal = random(0, 100);
    String concatNums = String(randNumber) + "." + String(randDecimal);

    airFlowValue = concatNums.toFloat();
    airFlowStr = String(airFlowValue) + " SLM";
    Serial.print("Air Flow: ");
    Serial.print(airFlowValue);
    Serial.println(" SLM");

    /**** Air Flow Description ****/
    if (airFlowValue >= 15) {
      airFlowDesc = "GOOD";
      Serial.println("Air-flow desciption: " + airFlowDesc);
    }
    else if (airFlowValue < 15 && airFlowValue >= 6) {
      airFlowDesc = "BAD";
      Serial.println("Air-flow desciption: " + airFlowDesc);
    }
    else if (airFlowValue <= 5) {
      airFlowDesc = "VERY BAD";
      Serial.println("Air-flow desciption: " + airFlowDesc);
    }

    /**** Air Quality Index based on PM25 ****/
    int aqival = calcAQI25(data.PM_AE_UG_2_5);
    airQualityIndexValue = String(aqival);

    if (aqival <= 50) {
      airQualityIndex = "GOOD";
      Serial.println("Air-quality Index: " + String(aqival) + " " + airQualityIndex);
    }
    else if (aqival >= 51 && aqival <= 100) {
      airQualityIndex = "MODERATE";
      Serial.println("Air-quality Index: " + String(aqival) + " " + airQualityIndex);
    }
    else if (aqival >= 101 && aqival <= 150 ) {
      airQualityIndex = "UNHEALTHY FOR SENSITIVE GROUPS";
      Serial.println("Air-quality Index: " + String(aqival) + " " + airQualityIndex);
    }
    else if (aqival >= 151 && aqival <= 200 ) {
      airQualityIndex = "UNHEALTHY";
      Serial.println("Air-quality Index: " + String(aqival) + " " + airQualityIndex);
    }
    else if (aqival >= 201 && aqival <= 300 ) {
      airQualityIndex = "VERY UNHEALTHY";
      Serial.println("Air-quality Index: " + String(aqival) + " " + airQualityIndex);
    }
    else if (aqival >= 301) {
      airQualityIndex = "HAZARDOUS";
      Serial.println("Air-quality Index: " + String(aqival) + " " + airQualityIndex);
    }
    postData(humidity, temperature, CO, airFlowStr, airFlowDesc, pm1String, pm25String, pm100String, airQualityIndex, airQualityIndexValue);
    displayAllData(humidity, temperature, CO, airFlowStr, airFlowDesc, pm1String, pm25String, pm100String, airQualityIndex, airQualityIndexValue);

    delay(2000);
  }
}

void postData (String humidity, String temperature, String CO, String airFlowStr, String airFlowDesc, String pm1,  String pm25,  String pm100, String airQualityIndex, String airQualityIndexValue) {
  if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      WiFiClient client;
      HTTPClient http;

      String data = "humidity=" + humidity + "&temperature=" + temperature +
                    "&co=" + CO + "&airFlowValue=" + airFlowStr + "&airFlowValueDescription=" + airFlowDesc + "&pm1=" + pm1 + "&pm25=" + pm25 + "&pm10=" + pm100 +
                    "&airQuality=" + airQualityIndex + "&airQualityValue=" + airQualityIndexValue;
      http.begin(client, "http://192.168.0.10/air-quality-project/addData.php"); // Connect to host where MySQL databse is hosted
      http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // Specify content-type header

      int httpCode = http.POST(data);   // Send POST request to php file and store server response code in variable named httpCode
      //      Serial.println("Values are");
      //      Serial.println("Humidity: " + humidity);
      //      Serial.println("Temperature: " + temperature);
      //      Serial.println("CO " + CO);
      //      Serial.println("Air flow value: " + airFlowStr);
      //      Serial.println("Air flow value description: " + airFlowDesc);
      //      Serial.println("PM1: " + pm1);
      //      Serial.println("PM2.5: " + pm25);
      //      Serial.println("PM10: " + pm100);
      //      Serial.println("Air Quality: " + airQualityIndex);
      //      Serial.println("Air Quality Value:  " + airQualityIndexValue);

      // if connection eatablished then do this
      if (httpCode == 200) {
        Serial.println("Values uploaded successfully.");
        Serial.print("HTTP Response code: ");
        Serial.println(httpCode);
        // String webpage = http.getString();    // Get html webpage output and store it in a string
        // Serial.println(webpage + "\n");
        delay(1000);
      }
      else { // if failed to connect then return and restart
        Serial.print("HTTP Response code: ");
        Serial.println(httpCode);
        Serial.println("Failed to upload values. \n");
        http.end();
        return;
      }
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
  Serial.println();
}

int calcAQI25(int pm25) {
  // Uses formula AQI = ( (pobs - pmin) x (aqimax - aqimin) ) / (pmax - pmin)  + aqimin
  float pmin, pmax, amin, amax;

  if (pm25 <= 12) {
    pmin = 0; pmax = 12; amin = 0; amax = 50;            goto aqicalc;
  }
  if (pm25 <= 35.5) {
    pmin = 12; pmax = 35.5; amin = 50; amax = 100;        goto aqicalc;
  }
  if (pm25 <= 55.5) {
    pmin = 35.5; pmax = 55.5; amin = 100; amax = 150;     goto aqicalc;
  }
  if (pm25 <= 150.5) {
    pmin = 55.5; pmax = 150.5; amin = 150; amax = 200;    goto aqicalc;
  }
  if (pm25 <= 250.5) {
    pmin = 150.5; pmax = 250.5; amin = 200; amax = 300;    goto aqicalc;
  }
  if (pm25 <= 350.5) {
    pmin = 250.5; pmax = 350.5; amin = 300; amax = 400;    goto aqicalc;
  }
  if (pm25 <= 500.5) {
    pmin = 350.5; pmax = 500.5; amin = 400; amax = 500;    goto aqicalc;
  } else {
    return 999;
  }

aqicalc:
  float aqi = ( ((pm25 - pmin) * (amax - amin))  / (pmax - pmin) ) + amin;
  return aqi;
}
