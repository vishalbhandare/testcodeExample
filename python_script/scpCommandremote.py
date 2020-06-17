import paramiko
from scp import SCPClient

def createSSHClient(server, port, user, password):
    client = paramiko.SSHClient()
    client.load_system_host_keys()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.connect(server, port, user, password)
    return client


server = '127.0.0.1'
port = '22'
user = 'vbhandare'
password = 'vbhandare'
ssh = createSSHClient(server, port, user, password)
scp = SCPClient(ssh.get_transport())
scp.put('exampleFile.txt', 'exampleFile.txt') # Copy my_file.txt to the server
