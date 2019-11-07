#def main(listData):
#    listAlerte = []
#    listeAlerte.append(calculAlerteAccel(listData[0]))
#
#
#    for capteur in listData:
#        alerteCapteur = []
#        for seconde in listData[capteur]:
#            alerteCapteur.append(calculAlerte())
#        listAlerte.append(alerteCapteur)

def calculAlerteAccel(listAccel, old_listAccel = []):
    alerteAccel = []
    for seconde in range(0, len(listAccel)):
        diff = []

        if(seconde != 0):
            for axis in range(0, len(listAccel[seconde].get_valeur())):
                if(listAccel[seconde].get_valeur()[axis] < 0):
                    diff.append(listAccel[seconde].get_valeur()[axis] - listAccel[seconde-1].get_valeur()[axis])
                else:
                    diff.append(listAccel[seconde].get_valeur()[axis] + listAccel[seconde-1].get_valeur()[axis])
            alerteAccel.append(diff)
        elif(seconde == 0 and old_listAccel):
            for axis in range(0, len(listAccel[seconde].get_valeur())):
                if(listAccel[seconde].get_valeur()[axis] < 0):
                    diff.append(listAccel[seconde].get_valeur()[axis] - old_listAccel[seconde-1].get_valeur()[axis])
                else:
                    diff.append(listAccel[seconde].get_valeur()[axis] + old_listAccel[seconde-1].get_valeur()[axis])
            alerteAccel.append(diff)

    return alerteAccel

