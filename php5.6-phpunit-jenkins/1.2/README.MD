<h1>PHP 5.6-phpunit-jenkins</h1>
This container follow the same version that version in apache server , you can build the same way that 
<strong>php5.6-apache:1.2</strong><br />
But this version it's specific to run test on phpunit using Jenkins.
 
<h3>Instructions before build</h3>
<ul>
    <li>
    Dockerfile -> <strong> WORKDIR</strong><br />
    Define the path to application relative a host machine , if you coding in this structure:
    <pre>
        /var/www/html ---------------- \
                \                       |
                 config_folder          |
                 |                      project1
                 |                      |
                 |                      |
                 |--------------------> dec \
                                             tests/
                                             index.php
                                             phpunit.xml
    </pre>
    then your workdir is<br />
    WORKDIR /var/www/html/dec
<h3>Custom Build</h3>
<pre>
Copy folders:
 - ../../build-container -> php5.6-phpunit-jenkins/1.2/build-container
 - ../../config-container -> php5.6-phpunit-jenkins/1.2/config-container
Edit:
 - dockerfile
RUN 
 - docker build .
</pre>
    <h3> Jenkins Pipeline Example: </h3> 
    <p>Url jenkins repositóry : https://github.com/diegosilva19/phpunitjenkins.git </p>
    <pre>
#!groovy
node {
    def app
    stage('SCM') {
       def scmInfo = checkout scm
       gitUrl = scmInfo.GIT_URL
    }
    <br />
    stage('Building Image'){
        docker.image('dtavares/php5.6-phpunit-jenkins:1.2').inside("-v /var/www/config_folder:/var/www/config_folder"){
           stage("Tests") {
                sh "pwd" ;
                sh "ls" ;
                sh 'phpunit --configuration phpunit.xml --log-junit build/phpunit.report.xml'
           }
        } 
    }
}
    </pre>
    </li>
</ul>
