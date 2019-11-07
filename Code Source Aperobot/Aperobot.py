# -*- coding: utf-8 -*-
#Main du projet

# |.| Déclaration des import nécessaires
import GestionFichier
import DonneeCapteur as d
import copy
import time
import traitementAlerte as processings

# |0| Initialisation des variables
dataOf_Accelerometer        = d.DonneeAccelerometre()
dataOf_EulerAngle           = d.DonneeAngleEuler()
dataOf_Gyroscope            = d.DonneeGyroscope()
dataOf_Magnetometer         = d.DonneeMagnetometre()
dataOf_Distance             = d.DonneeDistance()
dataOf_LightAndColor        = d.DonneeLumiereEtCouleur()
dataOf_Temperature          = d.DonneeTemperature()
dataOf_Loudness             = d.DonneeBruit()

listOfAccelerometer = [dataOf_Accelerometer]
listOfEulerAngle = [dataOf_EulerAngle]
listOfGyroscope = [dataOf_Gyroscope]
listOfMagnetometer = [dataOf_Magnetometer]
listOfDistance = [dataOf_Distance]
listOfLightAndColor = [dataOf_LightAndColor]
listOfTemperature = [dataOf_Temperature]
listOfLoudness = [dataOf_Loudness]

listOfDataSensor = []
for i in range(0, 9):
    listOfAccelerometer.append(copy.deepcopy(dataOf_Accelerometer))
    listOfEulerAngle.append(copy.deepcopy(dataOf_EulerAngle))
    listOfGyroscope.append(copy.deepcopy(dataOf_Gyroscope))
    listOfMagnetometer.append(copy.deepcopy(dataOf_Magnetometer))
    listOfDistance.append(copy.deepcopy(dataOf_Distance))
    listOfLightAndColor.append(copy.deepcopy(dataOf_LightAndColor))
    listOfTemperature.append(copy.deepcopy(dataOf_Temperature))
    listOfLoudness.append(copy.deepcopy(dataOf_Loudness))

listOfDataSensor.append(listOfAccelerometer)
listOfDataSensor.append(listOfEulerAngle)
listOfDataSensor.append(listOfGyroscope)
listOfDataSensor.append(listOfMagnetometer)
listOfDataSensor.append(listOfDistance)
listOfDataSensor.append(listOfLightAndColor)
listOfDataSensor.append(listOfTemperature)
listOfDataSensor.append(listOfLoudness)


while True:
    # |1| Initialisation des variables
    i = 0
    #start = time.time()

    # |2| Récupération des data sur ~10 secondes
    while i < 10:
        startRetrieveData = time.time()                 #Pour balayer tout les capteurs dans un intervalle à peu prés régulier (1s)
        for sensor in listOfDataSensor:
            sensor[i].retrieveData()
            #sensor[i].get_valeur()
            #print(sensor[i].getDataInFormatSQL())
        end = time.time() - startRetrieveData
        if (end < 1):
            print(end)
            time.sleep(1 - end)
        i+=1

    # |3| Traitement urgent pour alerte
    start = time.time()
    listT = processings.calculAlerteAccel(listOfDataSensor[0], listOfDataSensor[0])
    print("TIME : " + str(time.time() - start))
#    for x in listOfDataSensor:
#        print(x.getDataInFormatTXT())

    # |4| Enregistrer DATA
    GestionFichier.saveData(listOfDataSensor)

    # |5| Traitement selon alerte

    # |6| Vérifier si présence fichier à envoyer BDD
    GestionFichier.saveIfNeeded()
    break