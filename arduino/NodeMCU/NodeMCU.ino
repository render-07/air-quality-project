/* Code Written by Rishi Tiwari
    air-quality-project:- https://tricksumo.com
*/
#include <WiFi.h>
#include <HTTPClient.h>

#define WIFI_SSID "SKYFiber_MESH_8A64" // WIFI SSID here                                   
#define WIFI_PASSWORD "531062274" // WIFI password here

const int LED_POST_DATA = 2; // post data led indicator

// the following variables are unsigned longs because the time, measured in
// milliseconds, will quickly become a bigger number than can be stored in an int.
unsigned long lastTime = 0;
unsigned long timerDelay = 5; // Set timer to 5 seconds (5000)

void setup() {
  Serial.begin(115200);
  Serial.println("Communication Started \n\n");
  delay(1000);
  pinMode(LED_POST_DATA, OUTPUT);     // initialize built in led on the board
  WiFi.mode(WIFI_STA);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);                                     //try to connect with wifi
  Serial.print("Connecting to ");
  Serial.print(WIFI_SSID);
  while (WiFi.status() != WL_CONNECTED)
  { Serial.print(".");
    delay(500);
  }
  Serial.println();
  Serial.print("Connected to ");
  Serial.println(WIFI_SSID);
  Serial.print("IP Address is : ");
  Serial.println(WiFi.localIP());    //print local IP address
  delay(30);
}

double randomDouble(double minf, double maxf)
{
  return minf + random(1UL << 31) * (maxf - minf) / (1UL << 31);  // use 1ULL<<63 for max double values)
}

void loop() {
  String co_Array[3] = {"0.009", "0.010", "0.011"};
  
  String humidity = String(random(43, 45)) + " %";
  String temperature = String(random(28, 33)) + " °C";
  String co = co_Array[random(0, 3)];
  String airFlowValue = "1.5";
  String pm1String = String(random(9, 13));
  String pm25String = String(random(12, 18));
  String pm10String = String(random(18, 21));
  String airQuality = "GOOD";
  String airQualityValue = pm1String;

  //HTTPClient http;    // http object of clas HTTPClient
  //
  //
  //// Convert integer variables to string
  //sendval = String(val);
  //sendval2 = String(val2);
  //
  //
  //data = "sendval=" + sendval + "&sendval2=" + sendval2;
  //
  //// We can post values to PHP files as  example.com/dbwrite.php?name1=val1&name2=val2&name3=val3
  //// Hence created variable postDAta and stored our variables in it in desired format
  //// For more detials, refer:- https://www.tutorialspoint.com/php/php_get_post.htm
  //
  //// Update Host URL here:-
  //
  //http.begin("http://192.168.0.10/air-quality-project/addData.php");              // Connect to host where MySQL databse is hosted
  //http.addHeader("Content-Type", "application/x-www-form-urlencoded");            //Specify content-type header
  //
  //
  //
  //int httpCode = http.POST(postData);   // Send POST request to php file and store server response code in variable named httpCode
  //Serial.println("Values are, sendval = " + sendval + " and sendval2 = "+sendval2 );
  //
  //
  //// if connection eatablished then do this
  //if (httpCode == 200) { Serial.println("Values uploaded successfully."); Serial.println(httpCode);
  //String webpage = http.getString();    // Get html webpage output and store it in a string
  //Serial.println(webpage + "\n");
  //}
  //
  //// if failed to connect then return and restart
  //
  //else {
  //  Serial.println(httpCode);
  //  Serial.println("Failed to upload values. \n");
  //  http.end();
  //  return; }

  postData(humidity, temperature, co, airFlowValue, pm1String, pm25String, pm10String, airQuality, airQualityValue);
  delay(100);
}

void postData (String humidity, String temperature, String co, String airFlowValue,  String pm1,  String pm25,  String pm10, String airQuality, String airQualityValue) {
  if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      WiFiClient client;
      HTTPClient http;

      String data = "humidity=" + humidity + "&temperature=" + temperature +
                    "&co=" + co + "&airFlowValue=" + airFlowValue + "&pm1=" + pm1 + "&pm25=" + pm25 + "&pm10=" + pm10 +
                    "&airQuality=" + airQuality + "&airQualityValue=" + airQualityValue;
      http.begin("http://192.168.0.10/air-quality-project/addData.php"); // Connect to host where MySQL databse is hosted
      http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // Specify content-type header

      int httpCode = http.POST(data);   // Send POST request to php file and store server response code in variable named httpCode
      Serial.println("Values are");
      Serial.println("Humidity: " + humidity);
      Serial.println("Temperature: " + temperature);
      Serial.println("Co " + co);
      Serial.println("Air flow value: " + airFlowValue);
      Serial.println("PM1: " + pm1);
      Serial.println("PM2.5: " + pm25);
      Serial.println("PM10: " + pm10);
      Serial.println("Air Quality: " + airQuality);
      Serial.println("Air Quality Value:  " + airQualityValue);

      // if connection eatablished then do this
      if (httpCode == 200) {
        Serial.println("Values uploaded successfully.");
        Serial.print("HTTP Response code: ");
        Serial.println(httpCode);
        String webpage = http.getString();    // Get html webpage output and store it in a string
        Serial.println(webpage + "\n");
        digitalWrite(LED_POST_DATA, HIGH);
        delay(1000);
        digitalWrite(LED_POST_DATA, LOW);

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
}
