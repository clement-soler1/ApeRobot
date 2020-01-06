# -*- coding: utf-8 -*-

class Alerte:

    def __init__(self, atype, niveau, adate, atime):
        self.idVehicule = 3
        self.typeAlerte = atype
        self.niveauAlerte = niveau
        self.date = adate
        self.time = atime

    def getAlerteInFormatSQL(self):
        result = "INSERT INTO Ap_ReleveAlerte(idVehicule, typeAlerte, niveauAlerte, date, time)" \
            + " VALUES ( " + str(self.idVehicule) + ", " + str(self.typeAlerte) + ", " + str(self.niveauAlerte) + ", '" + str(self.date) + "', '" + str(self.time) +"');"
        return result

    def getAlerteInFormatTXT(self):
        result = str(self.idVehicule) + ">" + str(self.typeAlerte) + ">" + str(self.niveauAlerte) \
                      + ">" + str(self.date) + ">" + str(self.time) + "\n"
        return result