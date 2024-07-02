<?php

class Pizza 
{
	public array $ingredients = [];
	public $name;
}

abstract class PizzaBuilder
{
	// Формальная "заготовка" пиццы.
	protected Pizza $pizza;
	// При создании обеькта класса наследующего PizzaBuilder создается пицца.
	public function createNewPizza() 
	{
		$this->pizza = new Pizza();
	}

	// Дать пицце название.
	public function setPizzaName($name)
	{
		if (!empty($this->pizza)) {
			$this->pizza->name = $name;
		}
	}
	
	// Создать тесто
	abstract public function createDough(string $type);
	// Добавить сыр
	public function addCheese(string $type)
	{
		$this->pizza->ingredients[] = 'Сыр ' . $type;
	}
	// Добавить курицу
	public function addChicken()
	{
		$this->pizza->ingredients[] = 'Курочка';
	}
	// Добавить помидоры
	public function addTomatos()
	{
		$this->pizza->ingredients[] = 'Томаты';
	}
	// Добавить приправ
	public function addSeasonings(string $type) {
		$this->pizza->ingredients[] = 'Приправа ' . $type;
	}
	// Испечь
	public function bake(): Pizza {
		return $this->pizza;
	}
}

class DodoPizzaBuilder extends PizzaBuilder 
{
	// Мы обязаны определить как будет создаваться тесто.
	public function createDough(string $type)
	{
		$this->pizza->ingredients[] = 'Тесто с добавлением манки ' . $type;
	}
	// Добавить лук
	public function addOnions(string $type) {}
	// Добавить огурцы
	public function addCucumbers(string $type) {}
}

class DodoPizzaCreator
{
	private PizzaBuilder $pizzaBuilder;
	public function __construct() 
	{
		$this->pizzaBuilder = new DodoPizzaBuilder();
	}
	// Создать пиццу 'Четырые сыра мазератти'
	public function createFourMazerattiCheese() 
	{
		$this->pizzaBuilder->createNewPizza();
		$this->pizzaBuilder->setPizzaName('Четырые сыра мазератти.');
		$this->pizzaBuilder->createDough('тонкое');
		$this->pizzaBuilder->addCheese('пармезан');
		$this->pizzaBuilder->addCheese('чеддер');
		$this->pizzaBuilder->addCheese('дор-блю');
		$this->pizzaBuilder->addCheese('моцарелла');
		return $this->pizzaBuilder->bake();
	}
}
// Создаем "Менеджера (повара) пдодо-пицц"
$pizzaCreator = new DodoPizzaCreator();
// Создаем пиццу 'Четырые сыра мазератти'
$pizza = $pizzaCreator->createFourMazerattiCheese();
// Смотрим результат.
echo $pizza->name . PHP_EOL;
var_dump($pizza->ingredients);
echo "Приятного аппетита!";


