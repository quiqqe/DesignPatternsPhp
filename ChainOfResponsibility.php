<?php
// Класс для запроса
class Request
{
	public string $type;
}

// Абстрактный класс имеющий общие для цепочки методы
abstract class SupportService
{
    // следующий сервис
    protected $nextService;

    // метод для установки следующего элемента в цепочке
    // элемент должен быть наследован от данного абстрактного класса
    public function setNext(SupportService $service)
    {
        $this->nextService = $service;
    }

    // передача запроса следующему элементу цепочки
    public function handleRequest(string $request): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handleRequest($request);
        }
		echo "Запрос не может быть обработан\n";
        return null;
    }
}

// тех. поддержка email
class EmailSupport extends SupportService {
    public function handleRequest(string $request): ?string
    {
        if ($request->type === 'Email') {
            return "Запрос обработан через электронную почту\n";
        } else {
            parent::handleRequest($request);
        }
    }
}

// тех. поддержка чат
class ChatSupport extends SupportService {
    public function handleRequest(string $request): ?string
    {
        if ($request->type === 'Chat') {
            return "Запрос обработан через чат\n";
        } else {
            parent::handleRequest($request);
        }
    }
}

// мобильая тех. поддержка
class PhoneSupport extends SupportService {
    public function handleRequest(string $request): ?string
    {
        if ($request->type === 'Phone') {
            return "Запрос обработан по телефону\n";
        } else {
            parent::handleRequest($request);
        }
    }
}

// Создание цепочки
$email = new EmailSupport();
$chat = new ChatSupport();
$phone = new PhoneSupport();

$email->setNext($chat);
$chat->setNext($phone);

// Имитируем запрос
$request = new Request();
$request->type = 'Chat';
// Обработка запроса
$email->handleRequest($request);
