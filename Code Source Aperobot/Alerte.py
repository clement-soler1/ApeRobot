# -*- coding: utf-8 -*-

class Alerte:

    def __init__(self, atype, niveau, adate, atime):
        self.idVehicule = 1
        self.typeAlerte = atype
        self.niveauAlerte = niveau
        self.date = adate
        self.time = atime

    def getListDataInFormatSQL(self):
        result = "INSERT INTO Ap_ReleveAlerte(idVehicule, typeAlerte, niveauAlerte, date, time)" + \
            + " VALUES ( " + str(self.idVehicule) + ", " + str(self.typeAlerte) + ", " + str(self.niveauAlerte) + ", " + str(self.date) + ", " + str(self.time) +");"
        return result

    def getListDataInFormatTXT(self):
        result = ""
        for i in range(0, len(self.listData)):
            result += self.name + ">" + str(self.listDate[i]) + ">" + str(self.listTime[i]) + ">" + str(self.listData[i]) + "\n"
        return result