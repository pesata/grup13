# -*- mode: ruby -*-
# vi: set ft=ruby :
################################
#### Definició de variables ####
################################
IMATGE_BOX_NODES = "debian/bookworm64"
PROVIDER = "virtualbox"
NOM_BASE_OPS = "ops13"
NOM_BASE_DEV = "dev13"
NOM_DOMINI_NODES = ".clotfje.net"
CARPETA_MAQ_FIS = "../pj9f4a13"
CARPETA_MAQ_VIR = "/home/vagrant/grup13"
MEMORIA_RAM_OPS = 2048
MEMORIA_RAM_DEV = 1024
NUM_CPUS_OPS = 2
NUM_CPUS_DEV = 1
TARGETA_XARXA = "Intel(R) Wi-Fi 6 AX201 160MHz"

Vagrant.configure("2") do |node|
  ### Definició de la màquina de producció ###
  node.vm.define "produccio" do |prod|
    prod.vm.box = IMATGE_BOX_NODES
    prod.vm.hostname = NOM_BASE_OPS + NOM_DOMINI_NODES
    prod.vm.network "public_network", bridge: TARGETA_XARXA
    prod.vm.provider "virtualbox" do |provprod|
      provprod.name = NOM_BASE_OPS
      provprod.memory = MEMORIA_RAM_OPS
      provprod.cpus = NUM_CPUS_OPS
      provprod.customize ['modifyvm', :id, '--clipboard', 'bidirectional', '--groups', '/PIPELINE']
    end
  end

  ### Definició de la màquina de desenvolupament ###
  node.vm.define "desenvolupament" do |dev|
    dev.vm.box = IMATGE_BOX_NODES
    dev.vm.hostname = NOM_BASE_DEV + NOM_DOMINI_NODES
    dev.vm.network "public_network", bridge: TARGETA_XARXA
    dev.vm.synced_folder CARPETA_MAQ_FIS,CARPETA_MAQ_VIR
    dev.vm.provider "virtualbox" do |provdev|
      provdev.name = NOM_BASE_DEV
      provdev.memory = MEMORIA_RAM_DEV
      provdev.cpus = NUM_CPUS_DEV
      provdev.customize ['modifyvm', :id, '--clipboard', 'bidirectional', '--groups', '/PIPELINE']
    end
  end

  ### Aprovisionament de les màquines ###
  node.vm.provision "shell", inline: <<-SHELL
    sudo apt-get update -y
    sudo apt-get install -y net-tools whois aptitude git zip unzip curl
    sudo apt-get -y install apt-transport-https ca-certificates curl gnupg2 software-properties-common
    curl -fsSL https://download.docker.com/linux/debian/gpg | sudo apt-key add
    sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -cs) stable"
    sudo apt-get update -y
    sudo apt-get -y install docker-ce docker-ce-cli containerd.io docker-compose
    sudo gpasswd -a vagrant docker
  SHELL
end