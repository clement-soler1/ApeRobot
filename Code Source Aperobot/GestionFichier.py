# -*- coding: utf-8 -*-
import socket
import os
import time
import datetime as date
import GestionBDD

BDD = GestionBDD.GestionMySQL()

def __is_connected():
    try:
        socket.create_connection(("www.google.com", 80))
        return True
    except OSError:
        pass
    return False


def __delete_old_data():
    dir, age = './Data', 10
    age = int(age)*86400
    for file in os.listdir(dir):
        now = time.time()
        filepath = os.path.join(dir, file)
        modified = os.stat(filepath).st_mtime
        if modified < now - age:
            if os.path.isfile(filepath):
                os.remove(filepath)
                print('Deleted: %s' % (file))


def __saveDataLocalToTransferLater(listOfSensor, listOfAlerte):
    if not os.path.isdir('./DataToTransfer'):
        os.makedirs('./DataToTransfer')
    file = open("./DataToTransfer/dataToTransfer.sql","a")
    
    reslt = ""
    
    for sensor in listOfSensor:
        reslt += sensor.getListDataInFormatSQL() + '\n'
    
    if listOfAlerte:
        for alerte in listOfAlerte:
            reslt += alerte.getAlerteInFormatSQL()
    
    file.write(reslt)
    file.close()


def __saveDataInBDD(listOfSensor, listOfAlerte):
    listOfQuery = ""

    for sensor in listOfSensor:
        listOfQuery += sensor.getListDataInFormatSQL()

    if listOfAlerte:
        for alerte in listOfAlerte:
            listOfQuery += alerte.getAlerteInFormatSQL()

    BDD.sendQuery(str(listOfQuery))


def __saveDataLocal(listOfSensor, listOfAlerte):
    if not os.path.isdir('./Data'):
        os.makedirs('./Data')
    __delete_old_data()

    date_of_today = date.datetime.now().strftime('%d-%m-%Y')
    file = open("./Data/data_" + date_of_today + ".txt","a")
    reslt = ""

    for sensor in listOfSensor:
        reslt += sensor.getListDataInFormatTXT()

    if listOfAlerte:
        for alerte in listOfAlerte:
            reslt += alerte.getAlerteInFormatTXT()

    file.write(reslt)
    file.close()


def saveData(listOfSensor, listOfAlerte):
    if __is_connected():
        __saveDataInBDD(listOfSensor, listOfAlerte)
        __saveIfNeeded()
    else :
        __saveDataLocalToTransferLater(listOfSensor, listOfAlerte)
    __saveDataLocal(listOfSensor, listOfAlerte)


def __saveIfNeeded():
    if os.path.exists("./DataToTransfer/dataToTransfer.sql"):
        BDD.sendFile("./DataToTransfer/dataToTransfer.sql")
        os.remove("./DataToTransfer/dataToTransfer.sql")
