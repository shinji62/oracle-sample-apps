# Application to test with PHP Oracle Buildpack (Cloudfoundry)

Buildpack: 


### What is doing ?
*  Check if extension oci is loaded
* Try to connect to the specified Database


## Database
### Service Broker
    
        I could not find any broker for Oracle available so please
        make a PR if you find one.
        
### User provided service
        Example if you use this docker image [wnameless/oracle-xe-11g]: https://hub.docker.com/r/wnameless/oracle-xe-11g/
        ```shell
        cf cups oracle-11-docker -p  '{"username":"system","password":"oracle","host":"192.168.99.100","port":"49161","sid":"XE"}'
        ```
### Modify source code
        ```php
        $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.99.100)(PORT = 49161)))(CONNECT_DATA=(SID=XE)))";
        ```