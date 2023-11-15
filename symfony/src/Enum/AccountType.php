<?php

namespace App\Enum;

enum AccountType: string
{
    case CompteCourant = 'Compte courant';
    case LivretA = 'Livret A';
    case LivretJeune = 'Livret jeune';
    case PEL = 'PEL';
    case AssuranceVie = 'Assurance vie';
}