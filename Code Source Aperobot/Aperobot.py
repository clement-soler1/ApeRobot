# -*- coding: utf-8 -*-

#Main du projet

# |.| Déclaration des import nécessaires
import GestionFichier
import Sensors
import time
import TraitementAlerte as processings


# |0| Initialisation des variables
listOfSensor = []
listOfSensor.append(Sensors.Accelerometre())
listOfSensor.append(Sensors.AngleEuler())
listOfSensor.append(Sensors.Gyroscope())
listOfSensor.append(Sensors.Magnetometre())
listOfSensor.append(Sensors.Distance())
listOfSensor.append(Sensors.Temperature())
listOfSensor.append(Sensors.Bruit())
listOfSensor.append(Sensors.CouleurEtLuminosite())

while True:
    # |1| Initialisation des variables
    i = 0
    start = time.time()

    # |2| Récupération des data sur ~10 secondes
    while i < 10:
        startRetrieveData = time.time() #Pour balayer tout les capteurs dans un intervalle à peu prés régulier (1s)
        for sensor in listOfSensor:
            sensor.retrieveData()

        end = time.time() - startRetrieveData
        #print("TIME :" + str(end) + "\n")
        if (end < 1):
            time.sleep(1 - end)
        i += 1

    # |3| Traitement et récupération liste d'alerte
    listAl = processings.alerteProcess(listOfSensor)


    # |4| Enregistrer DATA
    GestionFichier.saveData(listOfSensor, listAl)