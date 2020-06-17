import pysftp

myHostname = "127.0.0.1"
myUsername = "vbhandare"
myPassword = "12345"

with pysftp.Connection(host=myHostname, username=myUsername, password=myPassword) as sftp:
    print("Connection succesfully stablished ... ")

    # Switch to a remote directory
    sftp.cwd('/var/www/vhosts/')

    localFilePath = 'exampleFile.txt'

    # Define the remote path where the file will be uploaded
    remoteFilePath = 'TUTORIAL2.txt'

    sftp.put(localFilePath, remoteFilePath)
