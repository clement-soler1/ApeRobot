# -*- coding: utf-8 -*-
import mysql.connector


def convertToBinaryData(filename):
    # Convert digital data to binary format
    with open(filename, 'rb') as file:
        binaryData = file.read()
    return binaryData

def sendQuery(query):
#    return 0

    connection = mysql.connector.connect(user='sornayj', database='sornayj', password='<wxcvbn,;:!123', host='webinfo.iutmontp.univ-montp2.fr')
    if connection.is_connected():
        db_Info = connection.get_server_info()
        print("Connected to MySQL Server version ", db_Info)
        cursor = connection.cursor()
        for result in cursor.execute(query, multi=True):
            if result.with_rows:
                print("Rows produced by statement '{}':".format(result.statement))
                record = result.fetchall()
                print("record :", record)
            else:
                print("Number of rows affected by statement '{}': {}".format( \
                        result.statement, result.rowcount))
    if (connection.is_connected()):
        cursor.close()
        connection.commit()
        connection.close()
        print("MySQL connection is closed")


def sendFile(path):
#    return 0
    file = open(path)
    sql = file.read()

    connection = mysql.connector.connect(user='sornayj', database='sornayj', password='<wxcvbn,;:!123', host='webinfo.iutmontp.univ-montp2.fr')
    if connection.is_connected():
        db_Info = connection.get_server_info()
        print("Connected to MySQL Server version ", db_Info)
        cursor = connection.cursor()
        for result in cursor.execute(sql, multi=True):
            if result.with_rows:
                print("Rows produced by statement '{}':".format(result.statement))
                print(result.fetchall())
            else:
                print("Number of rows affected by statement '{}': {}".format( \
                        result.statement, result.rowcount))
    if (connection.is_connected()):
        cursor.close()
        connection.commit()
        connection.close()
        print("MySQL connection is closed")
