# -*- coding: utf-8 -*-
import socket
import os
import time
import datetime as date
import GestionBDD as BDD

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


def __saveDataLocalToTransferLater(listOfSensor):
    if not os.path.isdir('./DataToTransfer'):
        os.makedirs('./DataToTransfer')
    file = open("./DataToTransfer/dataToTransfer.sql","a")
    reslt = ""
    for sensor in listOfSensor:
        reslt += sensor.getListDataInFormatSQL() + '\n'
    file.write(reslt)
    file.close()


def __saveDataInBDD(listOfSensor):
    listOfQuery = ""
    for sensor in listOfSensor:
        listOfQuery += sensor.getListDataInFormatSQL()
#    print(listOfQuery)
    BDD.sendQuery(str(listOfQuery))


def __saveDataLocal(listOfSensor):
    if not os.path.isdir('./Data'):
        os.makedirs('./Data')
    __delete_old_data()
    date_of_today = date.datetime.now().strftime('%d-%m-%Y')
    file = open("./Data/data_" + date_of_today + ".txt","a")
    reslt = ""
    for sensor in listOfSensor:
        reslt += sensor.getListDataInFormatTXT()
    file.write(reslt)
    file.close()
#    print("data : \n" + reslt)



def saveData(listOfSensor):
    if __is_connected():
        __saveDataInBDD(listOfSensor)
        __saveIfNeeded()
    else :
        __saveDataLocalToTransferLater(listOfSensor)
    __saveDataLocal(listOfSensor)


def __saveIfNeeded():
    if os.path.exists("./DataToTransfer/dataToTransfer.sql"):
        BDD.sendFile("./DataToTransfer/dataToTransfer.sql")
        os.remove("./DataToTransfer/dataToTransfer.sql")
