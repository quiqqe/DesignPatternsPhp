<?php

// Абстрактный класс "Приготовление пирога"
abstract class CakeRecipe {
    // Шаблонный метод
    // метод зашишен от переопределения
    final public function makeCake() {
        $this->prepareDough();
        $this->addFilling();
        $this->bake();
    }

    
    //Эти методы должны быть переопределены в подклассах
    // подготовить тесто
    abstract protected function prepareDough();
    // добавить начинку
    abstract protected function addFilling();

    // Стандартная (общая) реализация для всех видов пирогов
    protected function bake() {
        echo "Выпекаем пирог.\n";
    }
}

// Яблочный пирог.
class AppleCake extends CakeRecipe {
    protected function prepareDough() {
        echo "Готовим тесто для яблочного пирога.\n";
    }

    protected function addFilling() {
        echo "Добавляем яблочную начинку.\n";
    }
}

// Вишневый пирог.
class CherryCake extends CakeRecipe {
    protected function prepareDough() {
        echo "Готовим тесто для вишневого пирога.\n";
    }

    protected function addFilling() {
        echo "Добавляем вишневую начинку.\n";
    }
}

// Использование
$appleCake = new AppleCake();
$appleCake->makeCake();

$cherryCake = new CherryCake();
$cherryCake->makeCake();
