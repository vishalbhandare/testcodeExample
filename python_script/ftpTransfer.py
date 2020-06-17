from ftplib import FTP

#domain name or server ip:
ftp = FTP('speedtest.tele2.net')
#ftp.login(user='anonymous', passwd = 'vbsdare@gmail.com')
ftp.login()

#ftp.cwd('/whyfix/')

def placeFile():

    filename = 'exampleFile.txt'
    ftp.storbinary('STOR '+filename, open(filename, 'rb'))
    ftp.quit()

placeFile()
