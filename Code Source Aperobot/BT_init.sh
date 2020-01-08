#!/usr/bin/expect -f

set prompt "#"
set address "34:8A:7B:9D:44:6D"

spawn sudo bluetoothctl
send "discoverable on\r"
sleep 2
send "scan on\r"
expect -re "Device $address \.*"
send "scan off\r"
sleep 2
send "discoverable off\r"
sleep 2
send "pairable on\r"
sleep 2
send "agent NoInputNoOutput\r"
sleep 2
send "trust $address\r"
sleep 2
send "pair $address\r"
sleep 10
send "yes\r"
sleep 2
send "connect $address\r"
sleep 2
send "quit\r"
expect eof
