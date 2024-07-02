<?php

// Абстрактный класс "Ресторан" - родитель для всех ресторанов
abstract class Restaraunt {
	private $menu;
	private $adress;
	// Получить меню.
	public function getMenu() {}
	// Получить адрес ресторана.
	public function getAddress() {}
}

// Японский ресторан Тануки (наследник класса "Ресторан")
class Tanuki extends Restaraunt {}
// Итальянский ресторан ВиаРомано (наследник класса "Ресторан")
class ViaRomano extends Restaraunt {}
// Японский ресторан Окинва (наследник класса "Ресторан")
class Okinava extends Restaraunt {}
// Итальянский ресторан Джузеппе (наследник класса "Ресторан")
class Giuseppe extends Restaraunt {}

// Интерфейс для конкретных фабрик
interface AbstractRestaurantFactory {
	// Создать японский ресторан
	public function createJapanRestaraunt();
	// Создать итальянский ресторан
	public function createItalianRestaraunt();
}

// Конкретная фабрика для создания ресторанов в Москве
class MoscowRestarauntFactory implements AbstractRestaurantFactory {
	public function createJapanRestaraunt() 
	{
		// создает ресторан Тануки
		return Tanuki();
	}
	public function createItalianRestaraunt()
	{
		// создает ресторан ВиаРомано
		return ViaRomano();
	}
}

// Конкретная фабрика для создания ресторанов в Казани
class KazanRestarauntFactory implements AbstractRestaurantFactory {
	public function createJapanRestaraunt() 
	{
		// создает ресторан Окинва
		return Okinava();
	}
	public function createItalianRestaraunt()
	{
		// создает ресторан Джузеппе
		return Giuseppe();
	}
}	

