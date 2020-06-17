from pexpect import pxssh
s = pxssh.pxssh()
if not s.login ('localhost', 'vbhandare', 'vbhandare'):
    print("SSH session failed on login.")
    print(str(s))
else:
    print("SSH session login successful")
    s.setecho(True)
    s.sendline ('df -h')
    s.prompt()
    mydata = str(s.before).replace('\\r\\n', "\n")
    print(mydata)     # print everything before the prompt.
    s.sendline ('df -i')
    s.prompt()
    mydata = str(s.before).replace('\\r\\n', "\n")
    print(mydata)     # print everything before the prompt.
    s.logout()

#We can also execute multiple command like this:
