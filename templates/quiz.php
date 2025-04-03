<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapoot - Quiz</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="/assets/js/script.js" type="module" defer></script>
    <!-- icon link css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
</head>
<body>
    <!-- header -->
    <?php templatePart('navbar.php') ?>
    <!-- Main content -->
    <main role="main" class="quiz-page">
        <!-- title section -->
        <section class="title-container">
            <section class="title">
                <h1>Liste des quiz</h1>
                <div class="add-quiz-btn">
                    <a aria-label="bouton d'ajout de quiz" href="#"><i class="fa-solid fa-plus fa-xl"></i></a>
                </div>
            </section>
            <section class="search-box">
                <div class="content">
                    <input type="search" placeholder="Recherchez" value="">
                    <a href="#" aria-label="Rechercher" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
                <div class="filter">
                    <select aria-label="filtre" name="filter" id="filter">
                        <option value="">Trier par</option>       
                        <option value="dificult">Difficulté</option>       
                        <option value="date">Date</option>       
                    </select>
                </div>
            </section>
        </section>
        <!-- category section -->
        <section class="quiz-category">
            <div class="category">
                <ul class="category-group">
                    <li class="category-list active-category"><a class="category-link" href="#">Disponible</a></li>
                    <li class="category-list"><a class="category-link" href="#">En cours</a></li>
                    <li class="category-list"><a class="category-link" href="#">Brouillons</a></li>
                </ul>
            </div>
        </section>
        <!-- quiz card section -->
        <section class="card-section">
            <div class="section-container">
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
                <div class="card-container">
                    <div class="card-thumb">
                        <img src="/assets/img/placeholder.png" alt="quiz image">
                        <span class="level">Avancé</span>
                        <span class="date">21/03/2025</span>
                    </div>
                    <div class="card-info">
                        <h2 class="card-title">Cybersécurité : testez vos connaissances !</h2>
                        <p class="card-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt doloremque minus necessitatibus repellat odit quasi.</p>
                    </div>
                    <button type="button" class="card-btn">Rejoindre</button>
                </div>
            </div>
        </section>
    </main>
    <!-- footer -->
    <?php templatePart('footer.php') ?>
</body>
</html>