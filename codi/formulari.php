<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = htmlspecialchars($_POST["hostname"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Encriptar la contraseña
    $vlan2_name = htmlspecialchars($_POST["vlan2_name"]);
    $vlan3_name = htmlspecialchars($_POST["vlan3_name"]);
    $vlan4_name = htmlspecialchars($_POST["vlan4_name"]);
    $vlan2_start = intval($_POST["vlan2_start"]);
    $vlan2_end = intval($_POST["vlan2_end"]);
    $vlan3_start = intval($_POST["vlan3_start"]);
    $vlan3_end = intval($_POST["vlan3_end"]);
    $vlan4_start = intval($_POST["vlan4_start"]);
    $vlan4_end = intval($_POST["vlan4_end"]);

    echo "<h2>Configuració generada:</h2>";
    echo "<pre>";
    echo "enable\n";
    echo "configure terminal\n";
    echo "hostname $hostname\n";
    echo "enable secret $password\n";
    echo "vlan 2\n name $vlan2_name\n exit\n";
    echo "vlan 3\n name $vlan3_name\n exit\n";
    echo "vlan 4\n name $vlan4_name\n exit\n";
    
    for ($i = $vlan2_start; $i <= $vlan2_end; $i++) {
        echo "interface FastEthernet0/$i\n switchport mode access\n switchport access vlan 2\n exit\n";
    }
    for ($i = $vlan3_start; $i <= $vlan3_end; $i++) {
        echo "interface FastEthernet0/$i\n switchport mode access\n switchport access vlan 3\n exit\n";
    }
    for ($i = $vlan4_start; $i <= $vlan4_end; $i++) {
        echo "interface FastEthernet0/$i\n switchport mode access\n switchport access vlan 4\n exit\n";
    }
    echo "end\n";
    echo "write memory\n";
    echo "</pre>";
}