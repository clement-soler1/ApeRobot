## -*- coding: utf-8 -*-
import statistics

#Normalisation des axes à verifier et/ou à adapter :  X,Y,Z ; Heading,Roll,Pitch (comme dans les relevées)

def calculDeltaAxis(tab_axis): #fonctionne aussi pour le gyro
    alerteAxis = []
    listAxis = tab_axis.getListData()
    old_listAxis = tab_axis.getOldListData()
    
    if(old_listAxis):
        diff = []
        
        for axis in range(0, len(listAxis[0])): #il faut vérifier que suivant les valeurs prisent par le gyro le calcul reste pertinent exemple : 360° en moins d'une seconde ?
            if(listAxis[0][axis] < 0):
                diff.append(listAxis[0][axis] - old_listAxis[len(old_listAxis)-1][axis])
            else:
                diff.append(listAxis[0][axis] + old_listAxis[len(old_listAxis)-1][axis])
        alerteAxis.append(diff)

    
    for seconde in range(1, len(listAxis[1:])):
        diff = []

        for axis in range(0, len(listAxis[seconde])):
            if(listAxis[seconde][axis] < 0):
                diff.append(listAxis[seconde][axis] - listAxis[seconde-1][axis])
            else:
                diff.append(listAxis[seconde][axis] + listAxis[seconde-1][axis])
        alerteAxis.append(diff)

    return deltaAxis

def calculAlerteAccel(accel):
    alerteAccel = []
    for seconde in range(0, len(accel)):
        maximum = max(accel[seconde])
        if(maximum <=2):
            alerteAccel.append(0)
        elif(maximum > 2 AND maximum <10):
            alerteAccel.append(1)
        elif(maximum >= 10 AND maximum <20):
            alerteAccel.append(2)
        elif(maximum >=20):
            alerteAccel.append(3)

    return alertAccel

def calculAlerteGyro(gyro): #il faut vérifier les valeurs que peut prendre le gyro, et lesquelles sont acceptable.
    alerteAccel = []
    for seconde in range(0, len(accel)):
        maximum = max(gyro[seconde])
        if(maximum <=30):
            alerteAccel.append(0)
        elif(maximum > 30 AND maximum <90):
            alerteAccel.append(1)
        elif(maximum >= 90 AND maximum <180):
            alerteAccel.append(2)
        elif(maximum >=180):
            alerteAccel.append(3)

    return alerteAccel

def calculAlerteEuler(gyro): #il faut vérifier les valeurs que peut prendre le gyro, et lesquelles sont acceptable.
    alerteAccel = []
    for seconde in range(0, len(accel)):
        maximum = max(gyro[seconde])
        if(maximum <=30):
            alerteAccel.append(0)
        elif(maximum > 30 AND maximum <90):
            alerteAccel.append(1)
        elif(maximum >= 90 AND maximum <180):
            alerteAccel.append(2)
        elif(maximum >=180):
            alerteAccel.append(3)

    return alerteAccel


def calculAlerteTemperature(temperature):
    alerteTemperature = []
    listTemperature = temperature.getListData()

    alerteTemperature.append(min(listTemperature.getListData()))
    alerteTemperature.append(max(listTemperature.getListData()))
    alerteTemperature.append(statistics.mean(listTemperature.getListData()))

    return alerteTemperature

def calculAlerteDistance(distance):
    alerteDistance = []
    listDistance = distance.getListData()
    seuil_distance = 180

    for data in listDistance:
    	if (data[3] < seuil_distance):
    		alerteDistance.append(data)
    	else:
    		alerteDistance.append(-1)

    return alerteDistance

def calculAlerteBruit(bruit):
    alerteBruit = []
    listBruit = bruit.getListData()
    seuil_sonore = 60

    for data in listBruit:
    	if (data > seuil_lumineux):
    		alerteBruit.append(data)
    	else:
    		alerteBruit.append(-1)

    return alerteBruit

def calculAlerteLightAndColor(lightAndColor):
    alerteLightAndColor = []
    listLightAndColor = lightAndColor.getListData()
    seuil_lumineux = 180

    for data in listLightAndColor:
    	if (data[3] > seuil_lumineux):
    		alerteLightAndColor.append(data)
    	else:
    		alerteLightAndColor.append(-1)

    return alerteLightAndColor