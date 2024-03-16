<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Sub;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class Ext implements ProcessorInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $persistProcessor,
        #[Autowire(service: 'api_platform.doctrine.orm.state.remove_processor')]
        private ProcessorInterface $removeProcessor,
    )
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($operation instanceof DeleteOperationInterface) {
            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }
        // $s = new Sub();
        // $s->setName('Sub2');
        // $s->setMain($data);
        // $s->setTip($data->getSub()->first()->getTip());
        // $data->addSub($s);
        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);

        return $result;
    }
}
