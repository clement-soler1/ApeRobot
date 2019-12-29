## -*- coding: utf-8 -*-
import Alerte

def alerteProcess(listOfSensor):
    listAlerteObj = []
    listAlerteAccel = calculAlerteAccel(calculDeltaAxis(listOfSensor[0]))
    listAlerteGyro = calculAlerteGyro(calculDeltaAxis(listOfSensor[2]))
    listAlerteDist = calculAlerteDistance(listOfSensor[4])
    listAlerteTemp = calculAlerteTemperature(listOfSensor[5])
    listAlerteBruit = calculAlerteBruit(listOfSensor[6])
    listAlerteLight = calculAlerteLightAndColor(listOfSensor[7])
    
    maxAlerteAccel = max(listAlerteAccel)
    indexAlerteAccel = listAlerteAccel.index(maxAlerteAccel)
    
    maxAlerteGyro = max(listAlerteGyro)
    indexAlerteGyro = listAlerteGyro.index(maxAlerteGyro)
    
    maxAlerteDist = max(listAlerteDist)
    indexAlerteDist = listAlerteDist.index(maxAlerteDist)
    
    maxAlerteTemp = max(listAlerteTemp)
    indexAlerteTemp = listAlerteTemp.index(maxAlerteTemp)
    
    maxAlerteBruit = max(listAlerteBruit)
    indexAlerteBruit = listAlerteBruit.index(maxAlerteBruit)
    
    maxAlerteLight = max(listAlerteLight)
    indexAlerteLight = listAlerteLight.index(maxAlerteLight)
    
    listAlerteObj.append(Alerte.Alerte(listOfSensor[0], indexAlerteAccel, maxAlerteAccel))
    listAlerteObj.append(Alerte.Alerte(listOfSensor[2], indexAlerteGyro, maxAlerteGyro))
    listAlerteObj.append(Alerte.Alerte(listOfSensor[4], indexAlerteDist, maxAlerteDist))
    listAlerteObj.append(Alerte.Alerte(listOfSensor[5], indexAlerteTemp, maxAlerteTemp))
    listAlerteObj.append(Alerte.Alerte(listOfSensor[6], indexAlerteBruit, maxAlerteBruit))
    listAlerteObj.append(Alerte.Alerte(listOfSensor[7], indexAlerteLight, maxAlerteLight))
    return listAlerteObj
    
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

    return alerteAxis

def calculAlerteAccel(accel):
    alerteAccel = []
    for seconde in range(0, len(accel)):
        maximum = max(accel[seconde])
        if(maximum <=2):
            alerteAccel.append(0)
        elif(maximum > 2 and maximum <10):
            alerteAccel.append(1)
        elif(maximum >= 10 and maximum <20):
            alerteAccel.append(2)
        elif(maximum >=20):
            alerteAccel.append(3)

    return alerteAccel

def calculAlerteGyro(gyro): #il faut vérifier les valeurs que peut prendre le gyro, et lesquelles sont acceptable.
    alerteGyro = []
    for seconde in range(0, len(gyro)):
        maximum = max(gyro[seconde])
        if(maximum <=30):
            alerteGyro.append(0)
        elif(maximum > 30 and maximum <90):
            alerteGyro.append(1)
        elif(maximum >= 90 and maximum <180):
            alerteGyro.append(2)
        elif(maximum >=180):
            alerteGyro.append(3)

    return alerteGyro
    
def calculAlerteMagnetometre(magneto): #il faut vérifier les valeurs que peut prendre le gyro, et lesquelles sont acceptable.
    alerteAccel = []
    for seconde in range(0, len(magneto)):
        maximum = max(magneto[seconde])
        if(maximum <=30):
            alerteAccel.append(0)
        elif(maximum > 30 and maximum <90):
            alerteAccel.append(1)
        elif(maximum >= 90 and maximum <180):
            alerteAccel.append(2)
        elif(maximum >=180):
            alerteAccel.append(3)

    return alerteAccel


def calculAlerteTemperature(temperature):
    alerteTemperature = []
    listTemperature = temperature.getListData()
    for temp in listTemperature:
        if(temp < -5):
            alerteTemperature.append(1)
        elif(temp > 55):
            alerteTemperature.append(3)
        elif(temp > 45):
            alerteTemperature.append(2)
        elif(temp > 30):
            alerteTemperature.append(1)
        else: 
            alerteTemperature.append(0)
            
    return alerteTemperature

def calculAlerteDistance(distance):
    alerteDistance = []
    listDistance = distance.getListData()

    for data in listDistance:
        if (data in range(0, 5)):
            alerteDistance.append(2)
        elif(data < 10):
            alerteDistance.append(1)
        else:
            alerteDistance.append(0)
    return alerteDistance

def calculAlerteBruit(bruit):
    alerteBruit = []
    listBruit = bruit.getListData()

    for data in listBruit:
        if (data > 270):
            alerteBruit.append(1)
        else:
            alerteBruit.append(0)

    return alerteBruit

def calculAlerteLightAndColor(lightAndColor):
    alerteLightAndColor = []
    listLightAndColor = lightAndColor.getListData()

    for data in listLightAndColor:
        if (data[3] > 0.8):
            alerteLightAndColor.append(1)
        else:
            alerteLightAndColor.append(0)

    return alerteLightAndColor
