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
    
    if (maxAlerteAccel > 1 and maxAlerteGyro > 1):
        if (maxAlerteAccel > maxAlerteGyro):
            listAlerteObj.append(Alerte.Alerte(1, maxAlerteAccel, listOfSensor[0].getList()[1][indexAlerteAccel], listOfSensor[0].getList()[2][indexAlerteAccel]))
        else:
            listAlerteObj.append(Alerte.Alerte(1, maxAlerteGyro, listOfSensor[2].getList()[1][indexAlerteGyro], listOfSensor[2].getList()[2][indexAlerteGyro]))
            
        if (maxAlerteLight > 0):
            listAlerteObj.append(Alerte.Alerte(5, maxAlerteLight, listOfSensor[7].getList()[1][indexAlerteLight], listOfSensor[7].getList()[2][indexAlerteLight]))
            
    if (maxAlerteDist == 2 or (maxAlerteDist > 0 and maxAlerteAccel > 1)):
        listAlerteObj.append(Alerte.Alerte(2, maxAlerteDist, listOfSensor[4].getList()[1][indexAlerteDist], listOfSensor[4].getList()[2][indexAlerteDist]))
    
    if (maxAlerteTemp > 0):
        listAlerteObj.append(Alerte.Alerte(3, maxAlerteTemp, listOfSensor[5].getList()[1][indexAlerteTemp], listOfSensor[5].getList()[2][indexAlerteTemp]))
    
    if (maxAlerteBruit > 0):
        listAlerteObj.append(Alerte.Alerte(4, maxAlerteBruit, listOfSensor[6].getList()[1][indexAlerteBruit], listOfSensor[6].getList()[2][indexAlerteBruit]))
    
    return listAlerteObj
    

def calculDeltaAxis(tab_axis):
    alerteAxis = []
    listAxis = tab_axis.getList()[0]
    old_listAxis = tab_axis.getOldList()[0]
    
    if(old_listAxis):
        diff = []
        
        for axis in range(0, len(listAxis[0])):
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


def calculAlerteGyro(gyro):
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
    

def calculAlerteMagnetometre(magneto):
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
    listTemperature = temperature.getList()[0]
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
    listDistance = distance.getList()[0]

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
    listBruit = bruit.getList()[0]

    for data in listBruit:
        if (data > 270):
            alerteBruit.append(1)
        else:
            alerteBruit.append(0)

    return alerteBruit


def calculAlerteLightAndColor(lightAndColor):
    alerteLightAndColor = []
    listLightAndColor = lightAndColor.getList()[0]

    for data in listLightAndColor:
        if (data[3] > 0.8):
            alerteLightAndColor.append(1)
        else:
            alerteLightAndColor.append(0)

    return alerteLightAndColor
