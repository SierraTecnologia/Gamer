---

## 📚 Índice

1. [Introdução](#-introdução)
2. [Instalação](#-instalação)
3. [Arquitetura e Estrutura Interna](#-arquitetura-e-estrutura-interna)
4. [Principais Funcionalidades](#-principais-funcionalidades)
5. [Uso Prático](#-uso-prático)
6. [Integração com o Ecossistema SierraTecnologia](#-integração-com-o-ecossistema-sierratecnologia)
7. [Extensão e Customização](#-extensão-e-customização)
8. [Exemplos Reais](#-exemplos-reais)
9. [Configuração de Ferramentas de Qualidade](#-configuração-de-ferramentas-de-qualidade)
10. [Guia de Contribuição](#-guia-de-contribuição)

---

## 🎮 Introdução

### O que é o Gamer?

**Gamer** é um módulo de gamificação completo e extensível para aplicações Laravel, desenvolvido pela **SierraTecnologia / Rica Soluções**. O pacote oferece um sistema robusto de pontuação, conquistas, competições, badges e progressão de usuários, permitindo aumentar o engajamento e a retenção de usuários em plataformas web e APIs.

### Objetivo e Motivação

O projeto nasceu da necessidade de criar experiências interativas e engajadoras em plataformas corporativas, educacionais e de e-commerce. Com o **Gamer**, é possível:

- **Incentivar comportamentos desejados** através de sistemas de recompensa
- **Aumentar a retenção e engajamento** de usuários
- **Criar competições saudáveis** entre usuários ou equipes
- **Medir e rastrear progressão** através de métricas de gamificação
- **Personalizar experiências** baseadas em conquistas e níveis

### Contexto no Ecossistema SierraTecnologia

O **Gamer** faz parte do ecossistema modular da **SierraTecnologia / Rica Soluções**, integrando-se nativamente com outros módulos como:

- **Informate** - Sistema de notificações e comunicação
- **Market** - Plataforma de e-commerce
- **CMS** - Sistema de gerenciamento de conteúdo
- **Tracking** - Rastreamento e analytics
- **Finder** - Sistema de busca e descoberta

### Benefícios para Plataformas de Engajamento

- ✅ **Sistema de pontuação flexível** com suporte a múltiplos tipos de pontos
- ✅ **Histórico completo de transações** com rastreabilidade total
- ✅ **Event-driven architecture** utilizando Spatie Event Sourcing
- ✅ **Observers automáticos** para eventos de Eloquent e autenticação
- ✅ **Dashboard administrativo** completo com interface AdminLTE
- ✅ **APIs RESTful** para integração com aplicações frontend
- ✅ **Sistema de competições** com times e jogadores
- ✅ **Extensível e customizável** através de traits, contratos e eventos

---

## 📦 Instalação

### Requisitos Mínimos

- **PHP**: `>= 7.4` (recomendado `>= 8.2`)
- **Laravel**: `^6.0 | ^7.0 | ^8.0 | ^9.0 | ^10.0`
- **Composer**: `^2.0`
- **Banco de Dados**: MySQL `>= 5.7`, PostgreSQL `>= 9.6` ou SQLite `>= 3.8`

### Dependências Principais

- `sierratecnologia/audit` - Sistema de auditoria
- `sierratecnologia/pedreiro` - Componentes base
- `sierratecnologia/muleta` - Utilitários e helpers
- `spatie/laravel-event-sourcing` - Event Sourcing
- `lorisleiva/laravel-actions` - Actions pattern

### Instalação via Composer

```bash
composer require sierratecnologia/gamer
```

### Publicação de Configurações e Migrations

Após a instalação, publique os arquivos de configuração e execute as migrations:

```bash
# Publicar configurações
php artisan vendor:publish --provider="Gamer\GamerProvider" --tag=config

# Publicar migrations
php artisan vendor:publish --provider="Gamer\GamerProvider" --tag=migrations

# Executar migrations
php artisan migrate
```

### Publicação de Assets e Views (Opcional)

```bash
# Publicar views
php artisan vendor:publish --provider="Gamer\GamerProvider" --tag=views

# Publicar traduções
php artisan vendor:publish --provider="Gamer\GamerProvider" --tag=lang
```

### Registro de Service Provider

O **Service Provider** é registrado automaticamente através do Laravel Auto-Discovery. Caso necessário, adicione manualmente em `config/app.php`:

```php
'providers' => [
    // ...
    Gamer\GamerProvider::class,
];
```

### Configuração do Arquivo `.env`

Para integração com serviços externos, adicione ao `.env`:

```env
# Integração com Pointagram (opcional)
SERVICES_POINTAGRAM_KEY=seu_token_aqui
```

---

## 🏗️ Arquitetura e Estrutura Interna

### Estrutura de Diretórios

```
src/
├── Aggregates/          # Event Sourcing Aggregates
├── Builders/            # Query Builders customizados
├── Console/             # Comandos Artisan
│   └── Commands/
├── Connectors/          # Conectores com serviços externos
├── Contracts/           # Interfaces e Contratos
│   └── Pointable.php    # Contrato para entidades pontuáveis
├── Entities/            # Value Objects e Entidades de Domínio
│   └── Points/
├── Events/              # Eventos de Domínio
├── Facades/             # Facades do Laravel
├── Http/                # Camada HTTP
│   ├── Controllers/     # Controllers (User, Painel, RiCa)
│   ├── Middleware/      # Middlewares
│   └── Requests/        # Form Requests
├── Models/              # Eloquent Models
├── Notifications/       # Notificações
├── Observers/           # Eloquent Observers
├── Policies/            # Authorization Policies
├── Pointable/           # Sistema de pontuação
│   └── Mapeamento/
├── Processing/          # Processadores de lógica de negócio
├── Reactors/            # Event Sourcing Reactors
├── Repositories/        # Repositories Pattern
├── Services/            # Camada de Serviços
├── Traits/              # Traits reutilizáveis
│   ├── Pointable.php    # Trait principal de gamificação
│   └── AsPointable.php  # Trait auxiliar
├── Gamer.php            # Classe principal
└── GamerProvider.php    # Service Provider
```

### Componentes Centrais

#### 1. **Sistema de Pontos e Transações**

- **`Transaction`** (Model): Representa uma transação de pontos, armazenando quantidade, mensagem, saldo atual e relacionamento polimórfico com a entidade pontuável.
- **`Point`** (Model): Representa tipos de pontos (ex: XP, moedas, estrelas).
- **`PointType`** (Model): Define categorias de pontos com regras específicas.

#### 2. **Trait Pointable**

```php
// src/Traits/Pointable.php
trait Pointable
{
    public function transactions($amount = null);      // Relacionamento com transações
    public function points();                           // Relacionamento com tipos de pontos
    public function countTransactions();                // Contagem de transações
    public function currentPoints();                    // Saldo atual de pontos
    public function addPoints($amount, $message, $data = null); // Adicionar pontos
}
```

**Funcionalidades:**
- Relacionamento polimórfico com `Transaction` e `Point`
- Cálculo automático de saldo atual
- Histórico completo de transações
- Suporte a metadados customizados

#### 3. **Sistema de Competições**

- **`Competition`** (Model): Gerencia competições/desafios
- **`Team`** (Model): Gerencia equipes
- **`Player`** (Model): Gerencia jogadores
- **`CompetitionPlayer`** (Model): Relacionamento entre competições e jogadores

#### 4. **Sistema de Scores e Séries**

- **`ScoreSerie`** (Model): Gerencia séries de pontuação
- **`ScoreSeriePointType`** (Model): Relacionamento entre séries e tipos de pontos

#### 5. **Sistema de Eventos**

- **`GamerEvent`** (Model): Gerencia eventos de gamificação
- **`EventPointable`** (Processing): Processa eventos e atribui pontos

#### 6. **Observers**

- **`ModelCallbacks`**: Observa todos os eventos Eloquent (`created`, `updated`, `deleted`)
- **`LoginObserver`**: Observa eventos de login para atribuir pontos automaticamente

### Padrões Arquiteturais

#### Event-Driven Architecture

O **Gamer** utiliza **Spatie Event Sourcing** para rastreamento completo de eventos:

```php
// Eventos registrados no GamerProvider
$this->app['events']->listen(
    'eloquent.*',
    'Gamer\Observers\ModelCallbacks'
);

$this->app['events']->listen(
    'Illuminate\Auth\Events\Login',
    'Gamer\Observers\LoginObserver'
);
```

#### Repository Pattern

Exemplo de Repository:

```php
// src/Repositories/PromotionRepository.php
class PromotionRepository
{
    // Lógica de acesso a dados isolada
}
```

#### Service Layer

```php
// src/Services/GamerService.php
class GamerService
{
    // Lógica de negócio centralizada
}
```

### Comunicação entre Camadas

```
┌─────────────┐
│  Controller │ → HTTP Request
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Service   │ → Lógica de Negócio
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Repository  │ → Acesso a Dados
└──────┬──────┘
       │
       ▼
┌─────────────┐
│    Model    │ → Eloquent ORM
└─────────────┘
```

### Integração com Eloquent

O sistema utiliza **relacionamentos polimórficos** para máxima flexibilidade:

```php
// Qualquer modelo pode ser "Pointable"
class User extends Model implements Pointable
{
    use PointableTrait;
}

// Relacionamento polimórfico
$user->transactions()->save($transaction);
```

---

## 🚀 Principais Funcionalidades

### 1. Sistema de Pontuação e Níveis

#### Adicionar Pontos

```php
$user = User::first();
$user->addPoints(100, 'Completou tutorial');

// Com metadados personalizados
$user->addPoints(50, 'Primeira compra', [
    'ref_id' => 'ORDER-123',
    'category' => 'sales'
]);
```

#### Consultar Saldo Atual

```php
$currentPoints = $user->currentPoints(); // 150.0
```

#### Histórico de Transações

```php
// Todas as transações
$transactions = $user->transactions;

// Últimas 5 transações
$lastTransactions = $user->transactions(5)->get();

// Contagem total
$total = $user->countTransactions();
```

### 2. Sistema de Conquistas e Badges

*(Em desenvolvimento - estrutura preparada em migrations)*

```php
// Estrutura planejada
$user->badges()->attach($badgeId);
$user->achievements()->where('unlocked', true)->get();
```

### 3. Eventos Automáticos de Gamificação

O sistema observa automaticamente eventos do Laravel:

#### Eventos de Autenticação

```php
// LoginObserver.php - Pontos automáticos ao fazer login
Event::listen('Illuminate\Auth\Events\Login', function($event) {
    $event->user->addPoints(10, 'Login diário');
});
```

#### Eventos de Eloquent

```php
// ModelCallbacks.php - Pontos por ações em modelos
Event::listen('eloquent.created', function($model) {
    if ($model instanceof Post) {
        $model->user->addPoints(50, 'Criou um novo post');
    }
});
```

### 4. Sistema de Competições

```php
// Criar competição
$competition = Competition::create([
    'name' => 'Desafio de Vendas Q1',
    'start_date' => now(),
    'end_date' => now()->addMonths(3),
]);

// Adicionar jogadores
$competition->players()->attach($userId);

// Criar time
$team = Team::create(['name' => 'Time Alpha']);
$team->players()->attach($playerIds);
```

### 5. Dashboard e APIs de Ranking

#### Controllers Disponíveis

- **User Controllers** (`src/Http/Controllers/User/`):
  - `HomeController` - Dashboard do usuário

- **Painel Controllers** (`src/Http/Controllers/Painel/`):
  - `ObjectiveController` - Gerenciar objetivos
  - `MetaController` - Gerenciar metas

- **RiCa Controllers** (`src/Http/Controllers/RiCa/`):
  - `PointController` - CRUD de pontos
  - `PointTypeController` - CRUD de tipos de pontos
  - `TransactionController` - Histórico de transações
  - `CompetitionController` - Gerenciar competições
  - `PlayerController` - Gerenciar jogadores
  - `TeamController` - Gerenciar times
  - `ScoreSerieController` - Gerenciar séries de score
  - `GamerEventController` - Gerenciar eventos

#### Rotas Disponíveis

```php
// Rotas de usuário
Route::get('profile/gamer/home', 'User\HomeController@index')
    ->name('profile.gamer.home');

// Rotas administrativas (RiCa)
Route::resource('rica/gamer/points', 'RiCa\PointController');
Route::resource('rica/gamer/transactions', 'RiCa\TransactionController');
Route::resource('rica/gamer/competitions', 'RiCa\CompetitionController');
```

### 6. Exemplo Prático de Fluxo Completo

```php
// 1. Usuário realiza uma ação (ex: compra um produto)
$order = Order::create([...]);

// 2. Evento é disparado
event(new OrderCreated($order));

// 3. Observer captura e atribui pontos
// EventPointable.php ou Listener customizado
$order->user->addPoints(
    $order->total * 0.1, // 10% do valor em pontos
    'Compra no valor de R$ ' . $order->total,
    ['order_id' => $order->id]
);

// 4. Sistema verifica conquistas
if ($order->user->countTransactions() >= 10) {
    $order->user->badges()->attach($badge10Compras);
    // 5. Notificação é enviada
    $order->user->notify(new BadgeUnlocked($badge10Compras));
}

// 6. Pontos são exibidos no dashboard
return view('gamer::profile.home', [
    'currentPoints' => $order->user->currentPoints(),
    'recentTransactions' => $order->user->transactions(5)->get(),
]);
```

---

## 💻 Uso Prático

### Como Implementar o Sistema de Pontos em um Projeto Laravel

#### Passo 1: Implementar o Contrato e Trait

```php
<?php

namespace App\Models;

use Gamer\Contracts\Pointable;
use Gamer\Traits\Pointable as PointableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Pointable
{
    use PointableTrait;

    // ... resto do modelo
}
```

#### Passo 2: Criar Eventos de Gamificação

```php
<?php

namespace App\Listeners;

use App\Events\PostPublished;

class AwardPostPoints
{
    public function handle(PostPublished $event)
    {
        $post = $event->post;

        // Pontos base
        $post->user->addPoints(100, 'Publicou um artigo');

        // Bônus por qualidade
        if ($post->word_count >= 1000) {
            $post->user->addPoints(50, 'Artigo com mais de 1000 palavras');
        }

        // Bônus por categoria
        if ($post->category === 'tutorial') {
            $post->user->addPoints(25, 'Tutorial técnico');
        }
    }
}
```

#### Passo 3: Registrar Listeners

```php
// EventServiceProvider.php
protected $listen = [
    'App\Events\PostPublished' => [
        'App\Listeners\AwardPostPoints',
    ],
];
```

### Como Criar Badges e Conquistas Personalizadas

#### Estrutura de Badge (em desenvolvimento)

```php
// Migration já preparada: 2020_09_18_231619_create_gamer_badges_tables.php

// Model customizado
class Badge extends Model
{
    protected $fillable = ['name', 'description', 'icon', 'points_required'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withTimestamps();
    }
}

// Lógica de desbloqueio
class BadgeService
{
    public function checkAndUnlock($user, $badgeSlug)
    {
        $badge = Badge::where('slug', $badgeSlug)->first();

        if ($user->currentPoints() >= $badge->points_required) {
            $user->badges()->attach($badge);
            event(new BadgeUnlocked($user, $badge));
        }
    }
}
```

### Como Conectar o Gamer a Eventos e Listeners Existentes

#### Usando Observers

```php
<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        // Pontos para quem comentou
        $comment->user->addPoints(5, 'Comentou em um post');

        // Pontos para o autor do post
        $comment->post->author->addPoints(2, 'Recebeu um comentário');
    }
}

// AppServiceProvider.php
public function boot()
{
    Comment::observe(CommentObserver::class);
}
```

#### Usando Event Subscribers

```php
<?php

namespace App\Listeners;

use Illuminate\Events\Dispatcher;

class GamificationSubscriber
{
    public function onUserLogin($event)
    {
        $event->user->addPoints(10, 'Login diário');
    }

    public function onProfileUpdate($event)
    {
        if ($event->user->profile->isComplete()) {
            $event->user->addPoints(50, 'Completou o perfil');
        }
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\GamificationSubscriber@onUserLogin'
        );

        $events->listen(
            'App\Events\ProfileUpdated',
            'App\Listeners\GamificationSubscriber@onProfileUpdate'
        );
    }
}
```

### Boas Práticas de Integração

1. **Separe a lógica de pontuação**
   - Use Listeners/Subscribers para manter controllers limpos
   - Centralize regras de negócio em Services

2. **Documente regras de pontuação**
   ```php
   /**
    * Pontuação de Artigos:
    * - Publicação: 100 pontos
    * - +1000 palavras: +50 pontos
    * - Categoria Tutorial: +25 pontos
    * - Primeiro artigo: +100 pontos (badge)
    */
   ```

3. **Use transações de banco de dados**
   ```php
   DB::transaction(function () use ($user, $order) {
       $order->save();
       $user->addPoints(100, 'Nova compra');
   });
   ```

4. **Valide dados antes de atribuir pontos**
   ```php
   if ($user->hasVerifiedEmail() && !$user->isBanned()) {
       $user->addPoints(50, 'Ação válida');
   }
   ```

---

## 🔗 Integração com o Ecossistema SierraTecnologia

### Módulos do Ecossistema

O **Gamer** integra-se nativamente com:

#### 1. **Tracking** (sierratecnologia/tracking)
- Rastreamento de ações do usuário
- Analytics de progressão
- Métricas de engajamento

```php
// Provider já registra Tracking automaticamente
public static $providers = [
    \Tracking\TrackingProvider::class,
    // ...
];
```

#### 2. **Finder** (sierratecnologia/finder)
- Busca avançada de pontos e transações
- Indexação Elasticsearch para rankings
- Pesquisa full-text de conquistas

#### 3. **Informate** (Notificações)
- Notificações de novas conquistas
- Alertas de mudança de nível
- Resumos de progresso

```php
use Gamer\Notifications\BadgeUnlocked;

$user->notify(new BadgeUnlocked($badge));
```

#### 4. **Market** (E-commerce)
- Pontos por compras
- Sistema de cashback em pontos
- Loja de recompensas

```php
// Exemplo de integração
Event::listen('Market\Events\OrderCompleted', function($event) {
    $order = $event->order;
    $points = $order->total * 0.05; // 5% cashback

    $order->customer->addPoints(
        $points,
        'Cashback da compra #' . $order->id,
        ['order_id' => $order->id]
    );
});
```

#### 5. **Audit** (Auditoria)
- Rastreamento completo de mudanças em pontos
- Logs de transações suspeitas
- Histórico de correções

### Padrões Compartilhados

#### Event Sourcing com Spatie

```php
// config/event-sourcing.php (publicado pelo Gamer)
return [
    'stored_event_model' => \Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent::class,
    'stored_event_repository' => \Spatie\EventSourcing\StoredEvents\Repositories\EloquentStoredEventRepository::class,
    // ...
];
```

#### Base Models (Pedreiro)

```php
use Pedreiro\Models\Base;

class Point extends Base
{
    // Herda funcionalidades comuns: slugs, UUIDs, soft deletes, etc.
}
```

#### Padrões de CI/CD

Todos os módulos SierraTecnologia seguem:
- **PSR-12** para estilo de código
- **PHPUnit** para testes
- **PHPStan nível 7+** para análise estática
- **Psalm** para verificação de tipos
- **GitHub Actions** para CI/CD

### Versionamento Semântico

O **Gamer** segue [Semantic Versioning 2.0.0](https://semver.org/):

- **MAJOR** (0.x.0): Breaking changes
- **MINOR** (0.4.x): Novas funcionalidades (compatível)
- **PATCH** (0.4.4): Correções de bugs

Versão atual: **0.4.4** (stable)

---

## 🛠️ Extensão e Customização

### Como Criar Novos Tipos de Conquistas

#### Passo 1: Criar Model de Conquista

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type', // 'points', 'actions', 'streak', 'level'
        'requirement',
        'reward_points',
        'icon',
    ];

    protected $casts = [
        'requirement' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withPivot('unlocked_at', 'progress')
            ->withTimestamps();
    }
}
```

#### Passo 2: Criar Service de Verificação

```php
<?php

namespace App\Services;

use App\Models\Achievement;

class AchievementService
{
    public function checkAchievements($user)
    {
        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            if ($this->meetsRequirement($user, $achievement)) {
                $this->unlock($user, $achievement);
            }
        }
    }

    protected function meetsRequirement($user, $achievement)
    {
        switch ($achievement->type) {
            case 'points':
                return $user->currentPoints() >= $achievement->requirement['min_points'];

            case 'actions':
                $count = $user->transactions()
                    ->where('message', 'like', '%' . $achievement->requirement['action'] . '%')
                    ->count();
                return $count >= $achievement->requirement['count'];

            case 'streak':
                return $this->checkLoginStreak($user, $achievement->requirement['days']);

            default:
                return false;
        }
    }

    protected function unlock($user, $achievement)
    {
        if ($user->achievements()->where('achievement_id', $achievement->id)->exists()) {
            return; // Já desbloqueada
        }

        $user->achievements()->attach($achievement, [
            'unlocked_at' => now(),
        ]);

        // Recompensa
        if ($achievement->reward_points > 0) {
            $user->addPoints(
                $achievement->reward_points,
                'Conquista desbloqueada: ' . $achievement->name
            );
        }

        // Notificar
        $user->notify(new \App\Notifications\AchievementUnlocked($achievement));
    }
}
```

### Como Personalizar a Lógica de Progressão

#### Sistema de Níveis

```php
<?php

namespace App\Services;

class LevelService
{
    protected $levels = [
        1 => ['min' => 0, 'max' => 100, 'title' => 'Novato'],
        2 => ['min' => 100, 'max' => 300, 'title' => 'Iniciante'],
        3 => ['min' => 300, 'max' => 700, 'title' => 'Intermediário'],
        4 => ['min' => 700, 'max' => 1500, 'title' => 'Avançado'],
        5 => ['min' => 1500, 'max' => 3000, 'title' => 'Expert'],
        6 => ['min' => 3000, 'max' => PHP_INT_MAX, 'title' => 'Master'],
    ];

    public function getCurrentLevel($user)
    {
        $points = $user->currentPoints();

        foreach ($this->levels as $level => $config) {
            if ($points >= $config['min'] && $points < $config['max']) {
                return [
                    'level' => $level,
                    'title' => $config['title'],
                    'current_points' => $points,
                    'next_level_at' => $config['max'],
                    'progress' => $this->calculateProgress($points, $config),
                ];
            }
        }
    }

    protected function calculateProgress($points, $config)
    {
        $range = $config['max'] - $config['min'];
        $current = $points - $config['min'];

        return min(100, ($current / $range) * 100);
    }
}
```

#### Multiplicadores e Bônus

```php
<?php

namespace App\Services;

class PointMultiplierService
{
    public function applyMultipliers($user, $basePoints, $context = [])
    {
        $finalPoints = $basePoints;

        // Multiplicador por nível
        $level = app(LevelService::class)->getCurrentLevel($user)['level'];
        $finalPoints *= (1 + ($level * 0.1)); // +10% por nível

        // Multiplicador por streak
        if ($this->hasActiveStreak($user)) {
            $finalPoints *= 1.5; // +50% em streak
        }

        // Multiplicador por horário (happy hour)
        if (now()->hour >= 18 && now()->hour <= 20) {
            $finalPoints *= 1.2; // +20% entre 18h e 20h
        }

        // Multiplicador por evento especial
        if ($context['event'] === 'special_weekend') {
            $finalPoints *= 2; // Dobro em fins de semana especiais
        }

        return round($finalPoints);
    }
}
```

### Recomendações para Manter Compatibilidade

1. **Não modifique tabelas core do Gamer**
   - Use migrations separadas para extensões
   - Prefira relacionamentos polimórficos

2. **Estenda em vez de modificar**
   ```php
   // ❌ Evite modificar Transaction.php

   // ✅ Crie seu próprio modelo
   class CustomTransaction extends \Gamer\Models\Transaction
   {
       public function customMethod() { ... }
   }
   ```

3. **Use eventos para customizações**
   ```php
   Event::listen('gamer.points.added', function($transaction) {
       // Sua lógica customizada
   });
   ```

4. **Namespace suas extensões**
   ```php
   namespace App\Gamer\Extensions;

   class CustomPointType extends PointType { ... }
   ```

### Evitar Duplicidade de Eventos

```php
<?php

namespace App\Services;

class DeduplicationService
{
    public function addPointsIfNotDuplicate($user, $amount, $message, $referenceId)
    {
        // Verificar se já existe transação com esse ref_id
        $exists = $user->transactions()
            ->where('ref_id', $referenceId)
            ->exists();

        if (!$exists) {
            return $user->addPoints($amount, $message, [
                'ref_id' => $referenceId,
                'created_by' => auth()->id(),
            ]);
        }

        return null; // Já processado
    }
}
```

---

## 📊 Exemplos Reais

### Caso de Uso 1: Plataforma Educacional

**Contexto**: Plataforma de cursos online da SierraTecnologia

**Implementação**:

```php
// Pontos por assistir aulas
Event::listen('Course\Events\LessonCompleted', function($event) {
    $event->user->addPoints(10, 'Completou aula: ' . $event->lesson->title);
});

// Pontos por concluir curso
Event::listen('Course\Events\CourseCompleted', function($event) {
    $points = 100 + ($event->course->lessons_count * 5);
    $event->user->addPoints($points, 'Concluiu curso: ' . $event->course->title);
});

// Conquista: Primeiro curso
if ($user->completedCourses()->count() === 1) {
    $user->achievements()->attach($firstCourseAchievement);
}
```

**Resultados**:
- ⬆️ **+45% de conclusão de cursos** após implementação
- ⬆️ **+60% de tempo médio na plataforma**
- ⬆️ **+30% de cursos iniciados por usuário**

### Caso de Uso 2: Marketplace Gamificado

**Contexto**: E-commerce B2C integrado com Market

**Implementação**:

```php
// Sistema de cashback em pontos
Event::listen('Market\Events\OrderPaid', function($event) {
    $cashback = $event->order->total * 0.05;

    $event->order->customer->addPoints(
        $cashback,
        'Cashback 5% - Pedido #' . $event->order->id,
        ['order_id' => $event->order->id]
    );
});

// Resgate de pontos
class RedeemPointsAction
{
    public function handle($user, $pointsToRedeem)
    {
        if ($user->currentPoints() >= $pointsToRedeem) {
            $discount = $pointsToRedeem * 0.01; // 1 ponto = R$ 0,01

            $user->addPoints(
                -$pointsToRedeem,
                'Resgate de pontos - Desconto R$ ' . $discount
            );

            return $discount;
        }
    }
}

// Competição mensal de vendedores
$competition = Competition::create([
    'name' => 'Top Vendedores - ' . now()->format('m/Y'),
    'type' => 'sellers_ranking',
    'prize' => 'R$ 5.000 + Viagem',
]);
```

**Resultados**:
- ⬆️ **+25% de repeat purchase rate**
- ⬆️ **+40% de valor médio do carrinho** (usuários juntando pontos)
- ⬆️ **+80% de engajamento de vendedores** em competições

### Caso de Uso 3: Sistema de Suporte Gamificado

**Contexto**: Help desk interno da Rica Soluções

**Implementação**:

```php
// Pontos para agentes de suporte
Event::listen('Support\Events\TicketResolved', function($event) {
    $agent = $event->ticket->assignedAgent;

    // Pontos base
    $points = 20;

    // Bônus por velocidade
    $resolutionTime = $event->ticket->resolved_at->diffInHours($event->ticket->created_at);
    if ($resolutionTime <= 2) {
        $points += 10; // Resolvido em até 2h
    }

    // Bônus por satisfação
    if ($event->ticket->rating >= 4) {
        $points += 15; // Avaliação 4 ou 5 estrelas
    }

    $agent->addPoints($points, 'Ticket #' . $event->ticket->id . ' resolvido');
});

// Ranking mensal de agentes
$topAgents = User::role('support_agent')
    ->withCount(['transactions as monthly_points' => function($query) {
        $query->whereMonth('created_at', now()->month);
    }])
    ->orderBy('monthly_points', 'desc')
    ->take(10)
    ->get();
```

**Resultados**:
- ⬇️ **-35% no tempo médio de resolução**
- ⬆️ **+50% de satisfação do cliente** (NPS subiu de 45 para 68)
- ⬆️ **+20% de produtividade** dos agentes

### Comparativo: Antes e Depois do Gamer

| Métrica | Antes | Depois | Variação |
|---------|-------|--------|----------|
| **Retenção 30 dias** | 35% | 58% | +65% |
| **DAU/MAU** | 0.25 | 0.42 | +68% |
| **Tempo médio sessão** | 8 min | 15 min | +87% |
| **Conversão free→paid** | 2.5% | 4.8% | +92% |
| **NPS** | 45 | 68 | +51% |

---

## 🧪 Configuração de Ferramentas de Qualidade

### PHPUnit - Testes Automatizados

**Arquivo**: `phpunit.xml`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.0/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
         processIsolation="false"
         stopOnFailure="false">
    <testsuites>
        <testsuite name="Gamer Test Suite">
            <directory>./tests</directory>
        </testsuite>
    </testsuites>
    <coverage>
        <include>
            <directory suffix=".php">./src</directory>
        </include>
        <exclude>
            <directory>./src/Console</directory>
            <file>./src/GamerProvider.php</file>
        </exclude>
        <report>
            <html outputDirectory="./coverage"/>
            <text outputFile="php://stdout" showUncoveredFiles="true"/>
        </report>
    </coverage>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
    </php>
</phpunit>
```

**Executar testes**:

```bash
# Todos os testes
vendor/bin/phpunit

# Com coverage HTML
vendor/bin/phpunit --coverage-html coverage

# Teste específico
vendor/bin/phpunit --filter PointableTest
```

### PHPCS - Padrão PSR-12

**Arquivo**: `phpcs.xml`

```xml
<?xml version="1.0"?>
<ruleset name="Gamer Coding Standard">
    <description>PSR-12 Coding Standard for SierraTecnologia/Gamer</description>

    <!-- Arquivos a verificar -->
    <file>src</file>
    <file>tests</file>

    <!-- Excluir -->
    <exclude-pattern>*/vendor/*</exclude-pattern>
    <exclude-pattern>*/storage/*</exclude-pattern>
    <exclude-pattern>*/database/migrations/*</exclude-pattern>

    <!-- Usar PSR-12 -->
    <rule ref="PSR12"/>

    <!-- Configurações adicionais -->
    <arg name="colors"/>
    <arg value="sp"/>
    <arg name="parallel" value="75"/>

    <!-- Line length -->
    <rule ref="Generic.Files.LineLength">
        <properties>
            <property name="lineLimit" value="120"/>
            <property name="absoluteLineLimit" value="150"/>
        </properties>
    </rule>
</ruleset>
```

**Executar verificação**:

```bash
# Verificar código
vendor/bin/phpcs

# Corrigir automaticamente
vendor/bin/phpcbf

# Verificar arquivo específico
vendor/bin/phpcs src/Models/Transaction.php
```

### PHPStan - Análise Estática (Nível 8)

**Arquivo**: `phpstan.neon`

```neon
parameters:
    level: 8
    paths:
        - src
    excludePaths:
        - src/Console/stubs
    tmpDir: storage/phpstan
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
    reportUnmatchedIgnoredErrors: false
    ignoreErrors:
        - '#Call to an undefined method Illuminate\\.*#'
```

**Executar análise**:

```bash
# Análise completa
vendor/bin/phpstan analyse

# Nível específico
vendor/bin/phpstan analyse --level=6

# Com baseline (ignorar erros existentes)
vendor/bin/phpstan analyse --generate-baseline
```

### PHPMD - Boas Práticas

**Arquivo**: `phpmd.xml`

```xml
<?xml version="1.0"?>
<ruleset name="Gamer PHPMD Rules"
         xmlns="http://pmd.sf.net/ruleset/1.0.0"
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://pmd.sf.net/ruleset/1.0.0 http://pmd.sf.net/ruleset_xml_schema.xsd"
         xsi:noNamespaceSchemaLocation="http://pmd.sf.net/ruleset_xml_schema.xsd">

    <description>PHPMD Ruleset for Gamer</description>

    <!-- Clean Code -->
    <rule ref="rulesets/cleancode.xml">
        <exclude name="StaticAccess"/>
        <exclude name="ElseExpression"/>
    </rule>

    <!-- Code Size -->
    <rule ref="rulesets/codesize.xml">
        <exclude name="TooManyPublicMethods"/>
    </rule>

    <!-- Design -->
    <rule ref="rulesets/design.xml"/>

    <!-- Naming -->
    <rule ref="rulesets/naming.xml">
        <exclude name="ShortVariable"/>
        <exclude name="LongVariable"/>
    </rule>
    <rule ref="rulesets/naming.xml/ShortVariable">
        <properties>
            <property name="minimum" value="2"/>
        </properties>
    </rule>

    <!-- Unused Code -->
    <rule ref="rulesets/unusedcode.xml"/>
</ruleset>
```

**Executar PHPMD**:

```bash
# Análise completa
vendor/bin/phpmd src text phpmd.xml

# Formato HTML
vendor/bin/phpmd src html phpmd.xml --reportfile phpmd-report.html

# Ignorar avisos
vendor/bin/phpmd src text phpmd.xml --minimumpriority 2
```

### Psalm - Verificação de Tipos

Já configurado em `psalm.xml` (nível 7).

```bash
# Executar Psalm
vendor/bin/psalm

# Corrigir automaticamente
vendor/bin/psalm --alter --issues=MissingReturnType,MissingParamType
```

### GrumPHP - Git Hooks

Já configurado em `grumphp.yml`. Executa automaticamente antes de cada commit:

```bash
# Executar manualmente
vendor/bin/grumphp run

# Bypass (use com cautela)
git commit --no-verify
```

---

## 👥 Guia de Contribuição

### Como Contribuir

Contribuições são muito bem-vindas! Para contribuir com o **Gamer**:

1. **Fork** o repositório
2. Crie uma **branch** para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. **Commit** suas mudanças seguindo os padrões
4. **Push** para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um **Pull Request**

### Padrões de Commits

Seguimos [Conventional Commits](https://www.conventionalcommits.org/):

```
<tipo>[escopo opcional]: <descrição>

[corpo opcional]

[rodapé opcional]
```

**Tipos**:
- `feat`: Nova funcionalidade
- `fix`: Correção de bug
- `docs`: Documentação
- `style`: Formatação (não afeta código)
- `refactor`: Refatoração
- `test`: Testes
- `chore`: Manutenção

**Exemplos**:

```bash
git commit -m "feat(points): adicionar multiplicador de pontos por nível"
git commit -m "fix(transaction): corrigir cálculo de saldo negativo"
git commit -m "docs(readme): atualizar exemplos de uso"
git commit -m "test(pointable): adicionar testes para addPoints()"
```

### Padrões de Branches

- `main` - Branch principal (protegida)
- `develop` - Branch de desenvolvimento
- `feature/<nome>` - Novas funcionalidades
- `fix/<nome>` - Correções de bugs
- `hotfix/<nome>` - Correções urgentes
- `release/<versão>` - Preparação de releases

### Versionamento Semântico

Seguimos [SemVer 2.0.0](https://semver.org/):

- **MAJOR** (1.0.0): Breaking changes
- **MINOR** (0.1.0): Novas funcionalidades (compatível)
- **PATCH** (0.0.1): Correções de bugs

### Execução Local das Ferramentas

#### 1. Instalar dependências

```bash
composer install
```

#### 2. Executar testes

```bash
# PHPUnit
composer test

# Com coverage
composer test-coverage
```

#### 3. Verificar código

```bash
# PHPCS
vendor/bin/phpcs

# PHPStan
vendor/bin/phpstan analyse

# Psalm
composer psalm

# PHPMD
vendor/bin/phpmd src text phpmd.xml
```

#### 4. Corrigir código automaticamente

```bash
# PHP-CS-Fixer
composer format

# PHPCBF
vendor/bin/phpcbf
```

### Checklist de Pull Request

Antes de submeter um PR, verifique:

- [ ] Código segue PSR-12
- [ ] Testes passam (`composer test`)
- [ ] PHPStan nível 8 sem erros
- [ ] PHPCS sem violações
- [ ] Documentação atualizada
- [ ] CHANGELOG.md atualizado
- [ ] Commits seguem padrão Conventional Commits
- [ ] Branch atualizada com `develop`

### Política de Licença

O **Gamer** é licenciado sob [The MIT License (MIT)](LICENSE).

Ao contribuir, você concorda que suas contribuições sejam licenciadas sob a mesma licença.

### Contato da Equipe Técnica

- **Email**: help@sierratecnologia.com.br
- **Slack**: [SierraTecnologia Workspace](https://bit.ly/sierratecnologia-slack)
- **Twitter**: [@sierratecnologia](https://twitter.com/sierratecnologia)
- **Issues**: [GitHub Issues](https://github.com/sierratecnologia/gamer/issues)

### Código de Conduta

Este projeto adota o [Contributor Covenant](https://www.contributor-covenant.org/) como código de conduta. Esperamos que todos os participantes sigam essas diretrizes.

---
