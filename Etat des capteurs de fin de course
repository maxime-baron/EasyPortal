// Afficheur des états des bouton poussoir des capteurs de fin de course

const int buttonPin = 26;     // Port 26.
const int buttonPin1 = 27; // Port 27.

// Etat du bouton poussoir initialisé a zéro.
int buttonState = 0; // Gauche.
int buttonState1 = 0; // Droite.


void setup() {
  pinMode(buttonPin, INPUT); // Gauche.
  pinMode(buttonPin1, INPUT); // Droite.
  Serial.begin(9600);
}

void loop() {
  buttonState = digitalRead(buttonPin);
  buttonState1 = digitalRead(buttonPin1);

  if (buttonState == HIGH) { 
    Serial.println("appuyé"); // Etat du bouton actionné.
  } 
  else {
    Serial.println("relaché"); // Etat du bouton non-actionné.
  }
        if (buttonState1 == HIGH) { 
          Serial.println("appuyé1"); // Etat du bouton actionné.
    }   else {
          Serial.println("relaché1"); // Etat du bouton non-actionné.
  }
}
