<?php

namespace App\Modules\General\Person\Domain\Service;

use App\Modules\General\Person\Domain\Entity\PersonAddressEntity;
use App\Modules\General\Person\Domain\Entity\PersonContactEntity;
use App\Modules\General\Person\Domain\Entity\PersonEntity;

final class PersonBeforeSaveService
{
    protected PersonEntity $entity;    
    private function __construct(){}

    public static function make(): self {
        return new self();
    }

    public function execute(PersonEntity $entity): void {
        $this->entity = $entity;
        $this->handleAttributes();
    }

    private function handleAttributes(): void {
        $this->personAttributes();
        $this->personAddressAttributesCollection();
        $this->personContactAttributesCollection();
    }

    private function personAttributes(): void {
        $this->entity->ein     = onlyNumbers($this->entity->ein);
        $this->entity->zipcode = onlyNumbers($this->entity->zipcode);
    }

    private function personAddress(PersonAddressEntity $personAddress): void {
        $personAddress->zipcode = onlyNumbers($personAddress->zipcode);
    }

    private function personContact(PersonContactEntity $personContact): void {
        $personContact->ein  = onlyNumbers($personContact->ein);
        $personContact->type = $personContact->type ?? 'Outros';
    }

    private function personAddressAttributesCollection(): void {
       foreach ($this->entity->person_address as $personAddress) {
            $this->personAddress($personAddress);
        }
    }

    private function personContactAttributesCollection(){
        foreach ($this->entity->person_contact as $personContact) {
            $this->personContact($personContact);
        }
    }
}
