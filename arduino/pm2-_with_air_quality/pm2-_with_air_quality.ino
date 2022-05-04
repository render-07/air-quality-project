#include <Wire.h>
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);

#include <SoftwareSerial.h>
SoftwareSerial pmsSerial(10, 9); // tx rx
unsigned long previousMillis = 0;
unsigned long interval = 1000;

#include "DHT.h"
#define DHTPIN 2
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

#define RANGE              150
#define ZEROVOLTAGE        0.5
#define FULLRANGEVOLTAGE   4.5
#define VREF               5
int sensorPin = A1;
float sensorValue = 0;


int Kpin = A3;
int Kread;
int Hum;

const int AOUTpin = 0;
const int DOUTpin = 8;
const int ledPin = 13;
int limit;
int value;

void setup() {
  lcd.init();
  lcd.backlight();
  dht.begin();
  pinMode(DOUTpin, INPUT);
  pinMode(ledPin, OUTPUT);
  Serial.begin(115200);
  pmsSerial.begin(9600);
}

struct pms5003data {
  uint16_t framelen;
  uint16_t pm10_standard, pm25_standard, pm100_standard;
  uint16_t pm10_env, pm25_env, pm100_env;
  uint16_t particles_03um, particles_05um, particles_10um, particles_25um, particles_50um, particles_100um;
  uint16_t unused;
  uint16_t checksum;
};

struct pms5003data data;

void loop() {
  Kread = analogRead(Kpin);
  float humi  = dht.readHumidity();
  float tempC = dht.readTemperature();
  value = analogRead(AOUTpin);
  limit = digitalRead(DOUTpin);


  if (Kread > 0 and Kread < 50) {
    Hum = 3000;
  }
  if (Kread > 80 and Kread < 200) {
    Hum = 4000;
  }
  if (Kread > 300 and Kread < 350) {
    Hum = 5000;
  }
  if (Kread > 400 and Kread < 550) {
    Hum = 6000;
  }
  if (Kread > 700 and Kread < 750) {
    Hum = 7000;
  }

  //for SW1
  if (Hum == 3000) {

    lcd.clear();
    lcd.setCursor (0, 0);
    lcd.print("Humidity: ");
    lcd.print(humi);
    lcd.print("%");
    lcd.setCursor (0, 1);
    lcd.print(" Temp: ");
    lcd.print(tempC);
    lcd.print(" C ");
    delay(1000);

    if (Kread > 100 and Kread < 750) {
      Hum = 2000;
    }
  }
  //for SW2
  if (Hum == 4000) {

    lcd.clear();
    lcd.setCursor (0, 0);
    lcd.print("CO value: ");
    lcd.print(value);
    delay(1000);

    if (Kread > 0 and Kread < 50) {
      Hum = 2000;
    }
    if (Kread > 300 and Kread < 750) {
      Hum = 2000;
    }
  }
  //for SW3
  if (Hum == 5000) {

    lcd.clear();
    lcd.setCursor (0, 0);
    sensorValue = analogRead(sensorPin) * VREF;
    sensorValue = sensorValue / 1024;
    sensorValue = RANGE * (sensorValue - ZEROVOLTAGE) / (FULLRANGEVOLTAGE - ZEROVOLTAGE);
    lcd.print("Air Flow: ");
    lcd.setCursor (3, 1);
    lcd.print(sensorValue);
    lcd.print(" SLM");
    delay(1000);

    if (Kread > 0 and Kread < 150) {
      Hum = 2000;
    }
    if (Kread > 400 and Kread < 750) {
      Hum = 2000;
    }
  }
  //for SW4
  if (Hum == 6000) {
    String pm1String = String(data.pm10_standard);
    String pm25String = String(data.pm25_standard);
    String pm100String = String(data.pm100_standard);

    if (readPMSdata(&pmsSerial)) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("PM1  PM2.5  PM10");
      lcd.setCursor(0, 1);
      lcd.print(pm1String);
      Serial.println(pm1String);
      lcd.setCursor(5, 1);
      lcd.print(pm25String);
      Serial.println(pm25String);
      lcd.setCursor(12, 1);
      lcd.print(pm100String);
      Serial.println(pm100String);
    }
    delay(1000);

    if (Kread > 0 and Kread < 350) {
      Hum = 2000;
    }
    if (Kread > 700 and Kread < 750) {
      Hum = 2000;
    }
  }

  //for SW5
  if (Hum == 7000) {
    lcd.clear();
    lcd.setCursor (0, 0);
    lcd.print("SW5");

    int aqival = calcAQI25(data.pm25_env);

    if (aqival <= 12) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("Air-quality Index: GOOD");
      Serial.println("Air-quality Index:" + String(aqival) + " GOOD");
      lcd.setCursor(0, 1);
    }

    else if (aqival <= 35.5) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("Air-quality Index: MEDIUM");
      Serial.println("Air-quality Index:" + String(aqival) + " MEDIUM");
      lcd.setCursor(0, 1);
    }
    else if (aqival <= 55.5) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("Air-quality Index: BAD");
      Serial.println("Air-quality Index:" + String(aqival) + " BAD");
      lcd.setCursor(0, 1);
    }
    else if (aqival <= 150.5) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("Air-quality Index: MODERATE DANGER");
      Serial.println("Air-quality Index:" + String(aqival) + " MODERATE DANGER");
      lcd.setCursor(0, 1);
    }
    else if (aqival <= 250.5) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("Air-quality Index: CONSIDERABLE DANGER");
      Serial.println("Air-quality Index:" + String(aqival) + " CONSIDERABLE DANGER");
      lcd.setCursor(0, 1);
    }
    else if (aqival <= 350.5) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("Air-quality Index: HIGH DANGER");
      Serial.println("Air-quality Index:" + String(aqival) + " HIGH DANGER");
      lcd.setCursor(0, 1);
    }
    else if (aqival <= 500.5) {
      lcd.clear();//Clear the screen
      lcd.setCursor(0, 0);
      lcd.print("Air-quality Index: DEADLY");
      Serial.println("Air-quality Index:" + String(aqival) + " DEADLY");
      lcd.setCursor(0, 1);
    }
    delay(1000);

    if (Kread > 0 and Kread < 550) {
      Hum = 2000;
    }
  }
}

boolean readPMSdata(Stream *s) {
  if (! s->available()) {
    return false;
  }

  // Read a byte at a time until we get to the special '0x42' start-byte
  if (s->peek() != 0x42) {
    s->read();
    return false;
  }

  // Now read all 32 bytes
  if (s->available() < 32) {
    return false;
  }

  uint8_t buffer[32];
  uint16_t sum = 0;
  s->readBytes(buffer, 32);

  // get checksum ready
  for (uint8_t i = 0; i < 30; i++) {
    sum += buffer[i];
  }

  /* debugging
    for (uint8_t i=2; i<32; i++) {
    Serial.print("0x"); Serial.print(buffer[i], HEX); Serial.print(", ");
    }
    Serial.println();
  */

  // The data comes in endian'd, this solves it so it works on all platforms
  uint16_t buffer_u16[15];
  for (uint8_t i = 0; i < 15; i++) {
    buffer_u16[i] = buffer[2 + i * 2 + 1];
    buffer_u16[i] += (buffer[2 + i * 2] << 8);
  }

  // put it into a nice struct :)
  memcpy((void *)&data, (void *)buffer_u16, 30);

  if (sum != data.checksum) {
    Serial.println("Checksum failure");
    return false;
  }
  // success!
  return true;
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
