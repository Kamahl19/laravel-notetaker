<?php

return array(

  'username'                  => 'Užívateľské meno',
  'password'                  => 'Heslo',
  'password_confirmation'     => 'Potvrdiť heslo',
  'e_mail'                    => 'Email',
  'username_e_mail'           => 'Užívateľské meno alebo Email',

  'signup'  => array(
    'title'                   => 'Registrovať',
    'desc'                    => 'Vytvoriť nový účet',
    'confirmation_required'   => 'Vyžaduje sa aktivácia účtu emailom',
    'submit'                  => 'Registrovať',
  ),

  'login'   => array(
    'title'                   => 'Prihlásiť sa',
    'desc'                    => 'Zadajte svoje prihlasovacie údaje',
    'forgot_password'         => '(zabudol som heslo)',
    'remember'                => 'Zapamätať prihlásenie',
    'submit'                  => 'Prihlásiť',
  ),

  'forgot'  => array(
    'title'                   => 'Zabudnuté heslo',
    'submit'                  => 'Pokračovať',
  ),

  'alerts'  => array(
    'account_created'         => 'Váš účet bol úspešne vytvorený. Na email vám boli zaslané inštrukcie na aktiváciu účtu.',
    'too_many_attempts'       => 'Prekročili ste limit pokusov o registráciu. Skúste to opäť o niekoľko minút.',
    'wrong_credentials'       => 'Nesprávne užívateľské meno, email alebo heslo.',
    'not_confirmed'           => 'Váš účet nie je aktivovaný. Inštrukcie na aktiváciu vám boli zaslané na email.',
    'confirmation'            => 'Váš účet bol aktivovaný. Teraz sa môžete prihlásiť.',
    'wrong_confirmation'      => 'Nesprávny aktivačný kód.',
    'password_forgot'         => 'Inštrukcie na resetnutie hesla boli odoslané na váš email.',
    'wrong_password_forgot'   => 'Užívateľ nebol nájdený.',
    'password_reset'          => 'Vaše heslo bolo úspešne zmenené.',
    'wrong_password_reset'    => 'Nesprávne heslo.',
    'wrong_token'             => 'The password reset token is not valid.',
    'duplicated_credentials'  => 'The credentials provided have already been used. Try with different credentials.',
  ),

  'email'   => array(
    'account_confirmation'  => array(
      'subject'               => 'Account Confirmation',
      'greetings'             => 'Hello :name',
      'body'                  => 'Please access the link below to confirm your account.',
      'farewell'              => 'Regards',
    ),

    'password_reset'        => array(
      'subject'               => 'Password Reset',
      'greetings'             => 'Hello :name',
      'body'                  => 'Access the following link to change your password',
      'farewell'              => 'Regards',
    ),
  ),

);
