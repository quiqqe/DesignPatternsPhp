<?php
// Целевой интерфейс представляет устройства, которые работают на 220 вольт
interface RussianDeviceInterface {
    public function operateOn220V();
}

// Устройство, которое работает, использу 110 вольт
class Device {
    public function operateOn110V() {
        echo "Работает на 110 вольт\n";
    }
}

// Адаптер позволяет устройствам работать на 220 вольт, используя устройства, предназначенные для 110 вольт
class Adapter extends Device implements RussianDeviceInterface {
	// Метод, преобразующий напряжение из 220 в 110 вольт.
    public function operateOn220V() {
        echo "Адаптер преобразует 220 вольт в 110 вольт\n";
        $this->operateOn110V();
    }
}

// Клиентский код
function clientCode(Device $device) {
    $device->operateOn220V();
}

// Использование адаптера
$foreignDevice = new Device();
$adapter = new Adapter();
clientCode($adapter);
