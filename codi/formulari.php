<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = htmlspecialchars($_POST["hostname"]);
    $password = htmlspecialchars($_POST["password"]);
    $vlan2_name = htmlspecialchars($_POST["vlan2_name"]);
    $vlan3_name = htmlspecialchars($_POST["vlan3_name"]);
    $vlan4_name = htmlspecialchars($_POST["vlan4_name"]);
    $vlan5_name = htmlspecialchars($_POST["vlan5_name"]);
    $vlan2_start = intval($_POST["vlan2_start"]);
    $vlan2_end = intval($_POST["vlan2_end"]);
    $vlan3_start = intval($_POST["vlan3_start"]);
    $vlan3_end = intval($_POST["vlan3_end"]);
    $vlan4_start = intval($_POST["vlan4_start"]);
    $vlan4_end = intval($_POST["vlan4_end"]);
    $vlan5_start = intval($_POST["vlan5_start"]);
    $vlan5_end = intval($_POST["vlan5_end"]);

    echo "<h2>Configuració generada:</h2>";
    echo "<pre>";
    echo "<h3>Per entrar al mode privilegiat:</h3>";
    echo "enable\n";
    echo "configure terminal\n";

    echo "<h3>Per configurar el nom del hostname:</h3>";
    echo "hostname $hostname\n";

    echo "<h3>Per configurar la contrasenya:</h3>";
    echo "enable secret $password\n";

    echo "<h3>Per encriptar la contrasenya:</h3>";
    echo "service password-encryption\n";

    echo "<h3>Per configurar els noms de les VLANs:</h3>";
    echo "int vlan 2\n name $vlan2_name\n exit\n";
    echo "int vlan 3\n name $vlan3_name\n exit\n";
    echo "int vlan 4\n name $vlan4_name\n exit\n";
    echo "int vlan 5\n name $vlan5_name\n exit\n";

    echo "<h3>Per configurar les interfícies de les VLANs:</h3>";
    
    for ($i = $vlan2_start; $i <= $vlan2_end; $i++) {
        echo "interface FastEthernet0/$i\n switchport mode access\n switchport access vlan 2\n exit\n";
    }
    for ($i = $vlan3_start; $i <= $vlan3_end; $i++) {
        echo "interface FastEthernet0/$i\n switchport mode access\n switchport access vlan 3\n exit\n";
    }
    for ($i = $vlan4_start; $i <= $vlan4_end; $i++) {
        echo "interface FastEthernet0/$i\n switchport mode access\n switchport access vlan 4\n exit\n";
    }
    for ($i = $vlan5_start; $i <= $vlan5_end; $i++) {
        echo "interface FastEthernet0/$i\n switchport mode access\n switchport access vlan 5\n exit\n";
    }
    echo "end\n";

    echo "<h3> Per guardar la configuració en mode privilegiat:</h3>";
    echo "copy running-config startup-config\n";
    echo "</pre>";
}
