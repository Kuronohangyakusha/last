<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4 overflow-hidden">
    <div class="w-full h-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row h-full">
            <!-- Section gauche - Illustration -->
            <div class="lg:w-1/2 bg-gradient-to-br from-orange-400 to-orange-600 p-8 flex items-center justify-center">
                <div class="text-center">
                    <!-- Illustration stylisée -->
                    <div class="relative mb-8">
                        <!-- Téléphone -->
                        <div class="bg-gray-900 rounded-3xl p-4 w-64 h-96 mx-auto shadow-2xl transform rotate-3">
                            <div class="bg-white rounded-2xl h-full p-4">
                                <!-- Header du téléphone -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-6 h-6 bg-orange-500 rounded"></div>
                                    <div class="text-xs font-medium">Profil</div>
                                    <div class="w-6 h-6 bg-gray-300 rounded"></div>
                                </div>
                                
                                <!-- Contenu du téléphone -->
                                <div class="space-y-3">
                                    <div class="bg-gray-100 rounded-lg p-3">
                                        <div class="w-full h-16 bg-blue-200 rounded mb-2"></div>
                                        <div class="h-2 bg-gray-300 rounded w-3/4"></div>
                                        <div class="h-2 bg-gray-300 rounded w-1/2 mt-1"></div>
                                    </div>
                                    
                                    <div class="bg-gray-100 rounded-lg p-3">
                                        <div class="h-2 bg-gray-300 rounded w-full"></div>
                                        <div class="h-2 bg-gray-300 rounded w-2/3 mt-1"></div>
                                    </div>
                                    
                                    <div class="bg-orange-500 text-white rounded-lg p-3 text-center">
                                        <div class="text-sm font-bold">$29.99</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personnage -->
                        <div class="absolute -bottom-8 -left-12">
                            <div class="w-24 h-24 bg-gray-800 rounded-full"></div>
                            <div class="w-20 h-28 bg-orange-500 rounded-t-full mx-auto -mt-2"></div>
                            <div class="w-16 h-16 bg-gray-700 rounded-full mx-auto -mt-4"></div>
                        </div>
                        
                        <!-- Éléments décoratifs -->
                        <div class="absolute top-0 right-0 w-8 h-8 bg-white bg-opacity-20 rounded-full"></div>
                        <div class="absolute top-12 right-8 w-4 h-4 bg-white bg-opacity-30 rounded-full"></div>
                        <div class="absolute bottom-20 right-4 w-6 h-6 bg-white bg-opacity-25 rounded-full"></div>
                    </div>
                </div>
            </div>
            
            <!-- Section droite - Formulaire -->
            <div class="lg:w-1/2 p-8 overflow-y-auto">
                <div class="max-w-md mx-auto h-full flex flex-col justify-center">
                    <!-- Header -->
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-3">Connexion</h1>
                        <p class="text-gray-600">Connectez-vous à votre compte</p>
                        
                        <?php if($this->session->get('error')): ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 mt-4">
                                <?php foreach($this->session->get('error') as $field => $message): ?>
                                    <p><?= htmlspecialchars($message) ?></p>
                                <?php endforeach; ?>
                            </div>
                            <?php $this->session->set('error', null); ?>
                        <?php endif; ?>
                        
                        <?php if($this->session->get('success')): ?>
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 mt-4">
                                <p><?= htmlspecialchars($this->session->get('success')) ?></p>
                            </div>
                            <?php $this->session->set('success', null); ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Formulaire -->
                    <form class="space-y-8" action="dologin" method="POST">
                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3" >login</label>
                            <input name='login' value="<?= htmlspecialchars($_POST['login'] ?? '') ?>" class="w-full px-4 py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-colors text-lg" placeholder="Entrez votre numéro" required>
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Password</label>
                            <div class="relative">
                                <input type="password" name='password' class="w-full px-4 py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-colors text-lg pr-12" placeholder="Entrez votre mot de passe" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lien mot de passe oublié -->
                        <div class="text-right">
                            <a href="#" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Mot de passe oublié ?</a>
                        </div>
                        
                        <!-- Bouton -->
                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-4 px-4 rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 outline-none text-lg">
                            Connexion
                        </button>
                        
                        <!-- Séparateur -->
                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">ou</span>
                            </div>
                        </div>
                        
                        <!-- Lien inscription -->
                        <div class="text-center">
                            <p class="text-gray-600">Pas encore de compte ?</p>
                            <a href="inscription" class="text-orange-500 hover:text-orange-600 font-medium">Créer un compte</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>