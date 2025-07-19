<!-- Overlay pour mobile -->
<div class="overlay fixed inset-0 bg-black bg-opacity-50 z-10 md:hidden"></div>

<!-- Header mobile avec menu burger -->
<div class="md:hidden bg-white shadow-sm p-4 flex items-center justify-between">
    <h1 class="text-lg font-bold text-gray-900">Transactions</h1>
    <label for="menu-toggle" class="cursor-pointer p-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </label>
</div>

<!-- Contenu scrollable -->
<div class="flex-1 overflow-y-auto p-4 md:p-6">
    <!-- Header -->
    <div class="mb-6 md:mb-8 flex flex-col md:flex-row items-start justify-between gap-4">
        <!-- Partie principale : Titre -->
        <div>
            <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-2 hidden md:block">
                Liste De vos Transactions
            </h1>
            <div>
                <!-- Tu peux ajouter du contenu ici -->
            </div>
        </div>

        <!-- Rectangle à droite avec valeur statique -->
        <div class="bg-white border border-gray-300 rounded-2xl shadow-md p-4 min-w-[180px] text-center">
            <p class="text-gray-500 text-sm mb-1">Solde Total</p>
            <p class="text-2xl font-semibold text-green-600"><?= htmlspecialchars($user['solde']); ?></p>
        </div>
    </div>

    <!-- Tableau des transactions -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Transaction</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Type</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Date</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Montant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($userInfo as $key ) : ?>
                    <tr class="hover:bg-gray-50">

                        <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900"><?= $key['montant'] ?></td>
                        <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Retrait
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">13-02-2025</td>
                        <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900 font-medium">150ml</td>
                    </tr>
                    <?php endforeach ;?>
                    <!-- Répéter les lignes des transactions ici -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer avec statistiques -->
    <div class="flex flex-col sm:flex-row justify-between items-center mt-6 space-y-4 sm:space-y-0">
        <div class="bg-orange-500 text-white rounded-lg px-4 py-2 w-full sm:w-auto text-center">
            <span class="text-sm">voir tout</span>
        </div>
        <div class="bg-white rounded-lg shadow px-6 py-3 w-full sm:w-auto">
            <div class="text-center">
                <p class="text-sm text-gray-600">Total transaction</p>
                <p class="text-2xl font-bold text-orange-500">50</p>
            </div>
        </div>
    </div>
</div>
