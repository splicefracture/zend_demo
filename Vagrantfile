# -*- mode: ruby -*
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  #### application dirs

  config.vm.synced_folder "~/edu/zend_demo/application", "/var/www/application", id: "vagrant-root"
  config.vm.synced_folder "~/edu/zend_demo/public",      "/var/www/public",      id: "vagrant-root"
  config.vm.synced_folder "~/edu/zend_demo/tests",       "/var/www/tests",       id: "vagrant-root"
  config.vm.synced_folder "~/edu/zend_demo/docs",        "/var/www/docs",        id: "vagrant-root"
  config.vm.synced_folder "~/edu/zend_demo/library",     "/var/www/library",     id: "vagrant-root"

  #### build dirs
  
  config.vm.synced_folder "~/dev_ops/nodes/web", "/etc/puppet"
  
  config.vm.provider :virtualbox do |v|

    config.vm.box = "precise64"
    config.vm.box_url = "http://files.vagrantup.com/precise64.box"
    config.vm.hostname = "zend-demo.com.lcl"

    config.vm.network :private_network, ip: "192.168.56.114"
    config.ssh.forward_agent = true

    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--memory", 1024]

  end

  config.vm.provision :shell, :inline => "if [[ ! -f /apt-get-run ]]; then sudo apt-get update && sudo touch /apt-get-run; fi"
  config.vm.provision :shell, :inline => 'echo -e "mysql_root_password=devpass1 controluser_password=admin" > /etc/phpmyadmin.facts;'

  config.vm.provision :puppet do |puppet|

    puppet.manifests_path = "~/dev_ops/nodes/web/manifests"
    puppet.manifest_file = "demo.pp"
    puppet.module_path = "~/dev_ops/nodes/web/modules"
    puppet.options = ['--verbose']
  end

end
