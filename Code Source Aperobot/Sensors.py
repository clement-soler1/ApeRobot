# -*- coding: utf-8 -*-

import datetime as date
import copy
from di_sensors.inertial_measurement_unit import InertialMeasurementUnit
from di_sensors.easy_light_color_sensor import EasyLightColorSensor
import easygopigo3 as easy
gpg3_obj = easy.EasyGoPiGo3()
distance_sensor = gpg3_obj.init_distance_sensor()
loudness_sensor = gpg3_obj.init_loudness_sensor()
imu = InertialMeasurementUnit(bus = "GPG3_AD1")
my_lcs = EasyLightColorSensor(port='I2C', use_mutex=True, led_state=True)

class Sensor:

    def __init__(self, nom, capteur):
        self.idVehicule = 3
        self.listData = []
        self.listDate = []
        self.listTime = []
        self.name = nom
        self.oldListData = []
        self.oldListDate = []
        self.oldListTime = []
        self.sensor = capteur

    def retrieveData(self):
        if (len(self.listData) == 10):
            self.oldListData.clear()
            self.oldListDate.clear()
            self.oldListTime.clear()
            for i in range(0, len(self.listData)):
                self.oldListData.append(copy.deepcopy(self.listData[i]))
                self.oldListDate.append(copy.deepcopy(self.listDate[i]))
                self.oldListTime.append(copy.deepcopy(self.listTime[i]))
            self.listData.clear()
            self.listDate.clear()
            self.listTime.clear()

        self.listData.append(self.sensor())
        self.listDate.append(date.datetime.now().strftime('%Y-%m-%d'))
        self.listTime.append(date.datetime.now().strftime('%H:%M:%S'))

    def getListDataInFormatSQL(self):
        result = ""
        return result

    def getListDataInFormatTXT(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += self.name + ">" + str(self.listDate[i]) + ">" + str(self.listTime[i]) + ">" + str(self.listData[i]) + "\n"
        return result

    def getDataAt(self, index):
        return self.listData[index]

    def getList(self):
        liste = []
        liste.append(self.listData)
        liste.append(self.listDate)
        liste.append(self.listTime)
        return liste

    def getOldDataAt(self, index):
        return self.oldListData[index]

    def getOldList(self):
        liste = []
        liste.append(self.oldListData)
        liste.append(self.oldListDate)
        liste.append(self.oldListTime)
        return liste


###################################################Accelerometre###################################################

class Accelerometre(Sensor):

    def __init__(self):
        super().__init__("Ap_Accelerometer", imu.read_linear_acceleration)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 5, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][0]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 5, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][1]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 5, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][2]) + ");"

        return result


###################################################AngleEuler######################################################

class AngleEuler(Sensor):

    def __init__(self):
        super().__init__( "Ap_IMU", imu.read_euler)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 7, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][0]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 7, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][1]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 7, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][2]) + ");"

        return result


###################################################Gyroscope#######################################################

class Gyroscope(Sensor):

    def __init__(self):
        super().__init__( "Ap_Gyroscope", imu.read_gyroscope)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 6, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][0]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 6, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][1]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 6, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][2]) + ");"

        return result


###################################################Magnetometre####################################################

class Magnetometre(Sensor):

    def __init__(self):
        super().__init__( "Ap_Magnetometer", imu.read_magnetometer)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 8, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][0]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 8, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][1]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 8, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][2]) + ");"

        return result


###################################################Distance###################################################

class Distance(Sensor):

    def __init__(self):
        super().__init__( "Ap_DistanceSensor", distance_sensor.read)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 3, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i]) + ");"
        return result


###################################################Temperature###################################################

class Temperature(Sensor):

    def __init__(self):
        super().__init__( "Ap_Temperature", imu.read_temperature)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 1, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i]) + ");"
        return result


###################################################Bruit###################################################

class Bruit(Sensor):

    def __init__(self):
        super().__init__( "Ap_LoudnessSensor", loudness_sensor.read)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 4, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i]) + ");"
        return result


###################################################CouleurEtLuminosite###################################################

class CouleurEtLuminosite(Sensor):

    def __init__(self):
        super().__init__( "Ap_LightAndColorSensor", my_lcs.safe_raw_colors)

    def getListDataInFormatSQL(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 2, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][0]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 2, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][1]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 2, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][2]) + ");" \
                       + "CALL `insert_releve_and_data`( " + str(self.idVehicule) + ", 2, '" + str(self.listDate[i]) + "', '" + str(self.listTime[i]) + "', " + str(self.listData[i][3]) + ");"

        return result