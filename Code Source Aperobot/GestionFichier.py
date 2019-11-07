# -*- coding: utf-8 -*-
import socket
import os
import time
import datetime as date
import GestionBDD as BDD

def __is_connected():
    try:
        # ping un site pour savoir si une connection internet est presente
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


def __saveDataLocalToTransferLater(listOfDataSensor):
    if not os.path.isdir('./DataToTransfer'):
        os.makedirs('./DataToTransfer')
    file = open("./DataToTransfer/dataToTransfer.sql","a")
    reslt = ""
    for dataSensor in listOfDataSensor:
        reslt += dataSensor.getDataInFormatSQL() + '\n'
    file.write(reslt)


def __saveDataInBDD(listOfDataSensor):
    listOfQuery = ""
#    for sensor in listOfDataSensor:
    for data in listOfDataSensor[0]: #sensor:
        listOfQuery += data.getDataInFormatSQL()
#    #print(listOfQuery)
#    listOfQuery = "INSERT INTO `Ap_Accelerometer`(`idAccelerometer`, `date`, `time`, `X`, `Y`, `Z`) VALUES (1,'2019-11-07','12:21:12',0,0,0)"
    BDD.sendQuery(listOfQuery)


def __saveDataLocal(listOfDataSensor):
    if not os.path.isdir('./Data'):
        os.makedirs('./Data')
    __delete_old_data()
    date_of_today = date.datetime.now().strftime('%d-%m-%Y')
    file = open("./Data/data_" + date_of_today + ".txt","a")
    reslt = ""
    for sensor in listOfDataSensor:
        for data in sensor:
            reslt += data.getDataInFormatTXT() + '\n'
    reslt += '\n'
    file.write(reslt)
    #print("data : \n" + reslt)



def saveData(listOfDataSensor):
    if __is_connected():
        __saveDataInBDD(listOfDataSensor)
    else :
        __saveDataLocalToTransferLater(listOfDataSensor)
    __saveDataLocal(listOfDataSensor)


def saveIfNeeded():
    if __is_connected() and os.path.exists("./DataToTransfer/dataToTransfer.sql"):
        BDD.sendFile("./DataToTransfer/dataToTransfer.sql")
        os.remove("./DataToTransfer/dataToTransfer.sql")
