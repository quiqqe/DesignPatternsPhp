<?php
// Профиль пользователя
class UserProfile {
	public ?SecuritySettings $securitySettings = null;
	public ?Subscriptions $subscriptions = null;
	
	public function __construct()
	{
		$this->securitySettings = new SecuritySettings();
		$this->subscriptions = new Subscriptions();
	}
    public function updateProfile($data) {
        echo "Профиль обновлен с данными: " . json_encode($data) . "\n";
    }
}

// Настройки безопасности
class SecuritySettings {
	private string $password;
	private bool $twoFA;
    public function changePassword(string $newPassword) {
    	echo "Изменен пароль." . "\n";
    	$this->password = $newPassword;
    }

    public function enableTwoFactorAuthentication() {
    	$this->twoFA = true;
    	echo "Включена 2FA." . "\n";
    }
}

class Subscriptions {
    public function updateSubscription($subscription, $value) {
        echo "Подписка " . $subscription . " обновлена: " . $value . ".\n";
    }
}

// Фасад
class UserAccountFacade {

    public static function updateAccount(UserProfile $userProfile, $data) {
    	$data = json_decode($data, true);
        $userProfile->updateProfile($data['profile']);
        $userProfile->securitySettings->changePassword($data['security_settings']['new_password']);
        if (isset($data['security_settings']['2FA'])) {
        	$userProfile->securitySettings->enableTwoFactorAuthentication();
        }
        $subscriptionsData = $data['subscriptions'];
        foreach ($subscriptionsData as $subscription => $value) {
        	$userProfile->subscriptions->updateSubscription($subscription, $value);
        }
        
    }
}

// Использование фасада
$userProfile = new UserProfile();
$data = "{\"profile\":{\"name\":\"Ivan\",\"surname\":\"Ivanov\"},\"security_settings\":{\"new_password\":12345,\"2FA\":true},\"subscriptions\":{\"music\":\"premium\"}}";
UserAccountFacade::updateAccount($userProfile, $data);
