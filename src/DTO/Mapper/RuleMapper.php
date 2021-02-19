<?php


namespace App\DTO\Mapper;


use App\DTO\RuleDTO;
use App\Entity\Rule;
use Doctrine\Common\Collections\Collection;

class RuleMapper
{
    /**
     * @param Rule $rule
     * @return RuleDTO
     */
    public static function mapRuleDTO(Rule $rule):RuleDTO
    {
        $ruleDTO = new RuleDTO();
        $ruleDTO->setTitle($rule->getTitle());
        $ruleDTO->setDescription($rule->getDescription());
        $ruleDTO->setId($rule->getId());
        return  $ruleDTO;
    }

    /**
     * @param Collection|Rule[] $rules
     * @return Collection|RuleDTO[]
     */
    public static function mapRuleDTOs(Collection $rules):Collection
    {
        return $rules->map(function ($rule){
            return self::mapRuleDTO($rule);
        });
    }
}