#define RANGE              150    //Measurement Range
#define ZEROVOLTAGE        0.5    //Zero Voltage 
#define FULLRANGEVOLTAGE   4.5    //Full scale voltage
#define VREF               5      //Reference voltage

int sensorPin = A0;    // select the input pin for the air meter
float sensorValue = 0;
void setup() {
  Serial.begin(9600);
}

void loop() {
  // read the value from the sensor:
  sensorValue = analogRead(sensorPin)*VREF;
  sensorValue = sensorValue / 1024;
  sensorValue = RANGE*(sensorValue - ZEROVOLTAGE)/(FULLRANGEVOLTAGE - ZEROVOLTAGE);
  Serial.print(sensorValue);
  Serial.println(" SLM");
  delay(500);
}
