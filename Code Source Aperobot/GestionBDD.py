# -*- coding: utf-8 -*-
#import mysql.connector


def convertToBinaryData(filename):
    # Convert digital data to binary format
    with open(filename, 'rb') as file:
        binaryData = file.read()
    return binaryData

def sendQuery(query):
    return 0
#    cnx = mysql.connector.connect(user='sornayj', password='<wxcvbn,;:!123', host='webinfo', database='sornayj')
#    cursor = cnx.cursor()
#    print(query)
#
#    for result in cursor.execute(query, multi=True):
#        if result.with_rows:
#            print("Rows produced by statement '{}':".format(result.statement))
#            print(result.fetchall())
#        else:
#            print("Number of rows affected by statement '{}': {}".format( \
#                    result.statement, result.rowcount))
#    cnx.commit()
#    cnx.close()


def sendFile(path):
    return 0
#    file = open('path')
#    sql = file.read()
#
#    cnx = mysql.connector.connect(user='sornayj', password='<wxcvbn,;:!123', host='webinfo', database='sornayj')
#    cursor = cnx.cursor()
#
#    for result in cursor.execute(sql, multi=True):
#        if result.with_rows:
#            print("Rows produced by statement '{}':".format(result.statement))
#            print(result.fetchall())
#        else:
#            print("Number of rows affected by statement '{}': {}".format( \
#                    result.statement, result.rowcount))
#    cnx.commit()
#    cnx.close()
