# -*- coding: utf-8 -*-
#import easygopigo3 as easy
import datetime as date

#gpg3_obj = easy.EasyGoPiGo3()

class DonneeCapteur(object):

    def __init__(self, name=""):
        self.__nom = name
        self.__valeur = 0
        self.__date = 0
        self.__time = 0

    def get_nom(self):
        #print("Récupération du nom de la table de " + self.__nom)
        return self.__nom

    def get_valeur(self):
        #print("Récupération de la valeur de " + self.__nom)
        return self.__valeur

    def set_valeur(self, value):
        #print("Changement de la valeur de " + self.__nom)
        self.__valeur  =  value

    def get_date(self):
        #print("Récupération de la date de " + self.__nom)
        return self.__date;

    def set_date(self, dateT):
        #print("Changement de la date de " + self.__nom)
        self.__date = dateT

    def get_time(self):
        #print("Récupération du temps de " + self.__nom)
        return self.__time;

    def set_time(self, timeT):
        #print("Changement du temps de " + self.__nom)
        self.__time = timeT

    def getDataInFormatSQL(self):
            #on a créé une table par capteur donc pas besoin d'insérer le nom
        return "INSERT INTO " + str(self.__nom) + " VALUES( '" + str(self.__date) + "', '" + str(self.__time) + "', " + str(self.__valeur) + ");"

    def getDataInFormatTXT(self):
        #on a créé un fichier par type de données donc pas besoin du nom ici
        return "" + str(self.__nom) + ">" + str(self.__date) + ">" + str(self.__time)+ ">" + str(self.__valeur)


#######################################__Accélerometre__#######################################
class DonneeAccelerometre(DonneeCapteur):

#    __accelerometre_sensor = gpg3_obj.init_()

    def __init__(self):
        DonneeCapteur.__init__(self, name="Ap_Accelerometer")

    def retrieveData(self):
        DonneeCapteur.set_valeur(self, [-5,-4,-3])#DonneeAccelerometre.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))

    def getDataInFormatSQL(self):
            #on a créé une table par capteur donc pas besoin d'insérer le nom
        return str("INSERT INTO " + str(DonneeCapteur.get_nom(self)) + "(date,time,X,Y,Z) VALUES( '" + str(DonneeCapteur.get_date(self)) + "', '" \
                                        + str(DonneeCapteur.get_time(self)) + "', " + str(DonneeCapteur.get_valeur(self)[0]) + ", " \
                                        + str(DonneeCapteur.get_valeur(self)[1]) + ", " + str(DonneeCapteur.get_valeur(self)[2]) + ");")

    def getDataInFormatTXT(self):
        #on a créé un fichier par type de données donc pas besoin du nom ici
        return "" + str(DonneeCapteur.get_nom(self)) + ">" + str(DonneeCapteur.get_date(self)) + ">" \
            + str(DonneeCapteur.get_time(self)) + ">" + str(DonneeCapteur.get_valeur(self)[0]) + ">" \
            + str(DonneeCapteur.get_valeur(self)[1]) + ">" + str(DonneeCapteur.get_valeur(self)[2])

    @classmethod
    def getValueSensor():
        return DonneeAccelerometre.__accelerometre_sensor.read()



#######################################__EulerAngle__##########################################
class DonneeAngleEuler(DonneeCapteur):

#    __eulerAngle_sensor = gpg3_obj.init_()

    def __init__(self):
        DonneeCapteur.__init__(self, "Ap_IMU")


    def retrieveData(self):
        DonneeCapteur.set_valeur(self, [-2,-1,0])#DonneeAngleEuler.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))

    def getDataInFormatSQL(self):
            #on a créé une table par capteur donc pas besoin d'insérer le nom
        return str("INSERT INTO " + str(DonneeCapteur.get_nom(self)) + " VALUES( '" + str(DonneeCapteur.get_date(self)) + "', '" \
                                        + str(DonneeCapteur.get_time(self)) + "', " + str(DonneeCapteur.get_valeur(self)[0]) + ", "\
                                        + str(DonneeCapteur.get_valeur(self)[1]) + ", " + str(DonneeCapteur.get_valeur(self)[2]) + ");")

    def getDataInFormatTXT(self):
        #on a créé un fichier par type de données donc pas besoin du nom ici
        return "" + str(DonneeCapteur.get_nom(self)) + ">" + str(DonneeCapteur.get_date(self)) + ">" \
            + str(DonneeCapteur.get_time(self)) + ">" + str(DonneeCapteur.get_valeur(self)[0]) + ">" \
            + str(DonneeCapteur.get_valeur(self)[1]) + ">" + str(DonneeCapteur.get_valeur(self)[2])

    @classmethod
    def getValueSensor():
        return DonneeAngleEuler.__eulerAngle_sensor.read()



#######################################__Distance__############################################
class DonneeDistance(DonneeCapteur):

    #__distance_sensor = gpg3_obj.init_distance_sensor()

    def __init__(self):
        DonneeCapteur.__init__(self, "Ap_DistanceSensor")

    def retrieveData(self):
        DonneeCapteur.set_valeur(self, 5)#DonneeDistance.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))


#    @classmethod
#    def getValueSensor():
#        return DonneeDistance.__distance_sensor.read()



#######################################__Gyroscope__###########################################
class DonneeGyroscope(DonneeCapteur):

#    __gyroscope_sensor = gpg3_obj.init_()

    def __init__(self):
        DonneeCapteur.__init__(self, "Ap_Gyroscope")

    def retrieveData(self):
        DonneeCapteur.set_valeur(self, [0,1,2])#DonneeGyroscope.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))

    def getDataInFormatSQL(self):
            #on a créé une table par capteur donc pas besoin d'insérer le nom
        return str("INSERT INTO " + str(DonneeCapteur.get_nom(self)) + " VALUES( '" + str(DonneeCapteur.get_date(self)) + "', '" \
                                        + str(DonneeCapteur.get_time(self)) + "', " + str(DonneeCapteur.get_valeur(self)[0]) + ", " \
                                        + str(DonneeCapteur.get_valeur(self)[1]) + ", " + str(DonneeCapteur.get_valeur(self)[2]) + ");")

    def getDataInFormatTXT(self):
        #on a créé un fichier par type de données donc pas besoin du nom ici
        return "" + str(DonneeCapteur.get_nom(self)) + ">" + str(DonneeCapteur.get_date(self)) + ">" \
            + str(DonneeCapteur.get_time(self)) + ">" + str(DonneeCapteur.get_valeur(self)[0]) + ">" \
            + str(DonneeCapteur.get_valeur(self)[1]) + ">" + str(DonneeCapteur.get_valeur(self)[2])

#    @classmethod
#    def getValueSensor():
#        return DonneeGyroscope.__gyroscope_sensor.read()
#


#######################################__Magnetometre__########################################
class DonneeMagnetometre(DonneeCapteur):

#    __magnetometer_sensor = gpg3_obj.init_()

    def __init__(self):
        DonneeCapteur.__init__(self, "Ap_Magnetometer")


    def retrieveData(self):
        DonneeCapteur.set_valeur(self, [3,4,5])#DonneeMagnetometre.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))

    def getDataInFormatSQL(self):
            #on a créé une table par capteur donc pas besoin d'insérer le nom
        return str("INSERT INTO " + str(DonneeCapteur.get_nom(self)) + " VALUES( '" + str(DonneeCapteur.get_date(self)) + "', '" \
                                        + str(DonneeCapteur.get_time(self)) + "', " + str(DonneeCapteur.get_valeur(self)[0]) + ", " \
                                        + str(DonneeCapteur.get_valeur(self)[1]) + ", " + str(DonneeCapteur.get_valeur(self)[2]) + ");")

    def getDataInFormatTXT(self):
        #on a créé un fichier par type de données donc pas besoin du nom ici
        return "" + str(DonneeCapteur.get_nom(self)) + ">" + str(DonneeCapteur.get_date(self)) + ">" \
            + str(DonneeCapteur.get_time(self)) + ">" + str(DonneeCapteur.get_valeur(self)[0]) + ">" \
            + str(DonneeCapteur.get_valeur(self)[1]) + ">" + str(DonneeCapteur.get_valeur(self)[2])

#    @classmethod
#    def getValueSensor():
#        return DonneeMagnetometre.__magnetometer_sensor.read()
#



#######################################__LightAndColor__#######################################
class DonneeLumiereEtCouleur(DonneeCapteur):

#    __lightAndColor_sensor = gpg3_obj.init_()

    def __init__(self):
        DonneeCapteur.__init__(self, "Ap_LightAndColorSensor")

    def retrieveData(self):
        DonneeCapteur.set_valeur(self, [6,7,8,9])#DonneeLumiereEtCouleur.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))

    def getDataInFormatSQL(self):
            #on a créé une table par capteur donc pas besoin d'insérer le nom
        return str("INSERT INTO " + str(DonneeCapteur.get_nom(self)) + " VALUES( '" + str(DonneeCapteur.get_date(self)) + "', '" \
                                        + str(DonneeCapteur.get_time(self)) + "', " + str(DonneeCapteur.get_valeur(self)[0]) + ", " \
                                        + str(DonneeCapteur.get_valeur(self)[1]) + ", " + str(DonneeCapteur.get_valeur(self)[2]) + ", " \
                                        + str(DonneeCapteur.get_valeur(self)[3]) + ");")

#    def getDataInFormatTXT(self):
#        #on a créé un fichier par type de données donc pas besoin du nom ici
#        return "" + str(DonneeCapteur.get_nom(self)) + ">" + str(DonneeCapteur.get_date(self)) + ">" \
#            + str(DonneeCapteur.get_time(self)) + ">" + str(DonneeCapteur.get_valeur(self)[0]) + ">" \
#            + str(DonneeCapteur.get_valeur(self)[1]) + ">" + str(DonneeCapteur.get_valeur(self)[2]) \
#            + ">" + str(DonneeCapteur.get_valeur(self)[3])
#
#    @classmethod
#    def getValueSensor():
#        return DonneeLumiereEtCouleur.__lightAndColor_sensor.read()
#


#######################################__Temperature__#########################################
class DonneeTemperature(DonneeCapteur):

#    __temperature_sensor = gpg3_obj.()

    def __init__(self):
        DonneeCapteur.__init__(self, "Ap_Temperature")

    def retrieveData(self):
        DonneeCapteur.set_valeur(self, 10)#DonneeTemperature.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))

#    @classmethod
#    def getValueSensor():
#        return DonneeTemperature.__temperature_sensor.read()
#


#######################################__Loudness__############################################
class DonneeBruit(DonneeCapteur):

#    __loudness_sensor = gpg3_obj.init_loudness_sensor()

    def __init__(self):
        DonneeCapteur.__init__(self, "Ap_LoudnessSensor")

    def retrieveData(self):
        DonneeCapteur.set_valeur(self, 11)#DonneeBruit.getValueSensor())
        DonneeCapteur.set_date(self, date.datetime.now().strftime('%Y-%m-%d'))
        DonneeCapteur.set_time(self, date.datetime.now().strftime('%H:%M:%S'))

#    @classmethod
#    def getValueSensor():
#        return DonneeBruit.__loudness_sensor.read()




########################################__Motion__##############################################
#class DonneeMouvement(DonneeCapteur):
#
#    __motion_sensor = gpg3_obj.init_motion_sensor("AD2")
#
#    def __init__(self):
#        DonneeCapteur.__init__(self, "Mouvement")
#
#    def retrieveData(self):
#        DonneeCapteur.set_valeur(self, 8)#FDonneeMouvement.getValueSensor())
#        DonneeCapteur.set_date(self, date.datetime.now().strftime('%d/%m/%Y ; %H:%M:%S'))
#
#    @classmethod
#    def getValueSensor():
#        return DonneeMouvement.__motion_sensor.motion_detected()
