import telnetlib, re

# for validating an Ip-address
regex = '''^(25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.(
            25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.(
            25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.(
            25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)$'''

def check(Ip):
    return re.search(regex, Ip)

ipAddress = raw_input("Enter IP Address: ")

if not check(ipAddress):
    print "Enter Valid IP Address"
    exit()

port =  raw_input("Enter Port to listen: ")

if not (port.isdigit() and 1 <= int(port) <= 65535):
    print "Enter Valid Port Number"
    exit()

try:
    conn = telnetlib.Telnet(ipAddress, port)
    response = 'Success'
except:
    response = 'Failed'
finally:
    print(response)
