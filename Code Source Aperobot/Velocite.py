# -*- coding: utf-8 -*-
import GestionFichier
import time
import math
#import ?
#    __accelerometre_sensor = gpg3_obj.init_()

velocite = 10
def calculVelocite():
    acceleration = [5,1,2]
    global velocite
    velocite += math.sqrt(acceleration[0]**2 + acceleration[1]**2 + acceleration[2]**2) * 0.1
    return 0;

def getVelocite():
    return velocite

i = 0
while True:
    start = time.time()
    calculVelocite()
    i += 1
    if (i == 10):
        #GestionFichier.save()
        print("val = " + str(velocite))
        i = 0
    time.sleep(0.01 - (time.time() - start))