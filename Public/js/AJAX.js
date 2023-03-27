const selectType = document.getElementById("TypePokemon");

selectType.addEventListener('change', function(event) {
    const url = document.location.pathname + '?view=getTypeID&IDType=' + selectType.value;
    fetch(url)
        .then(response => response.json())
        .then(function(pokemons) {
            const divPokemon = document.getElementById('TabPokemon');
            divPokemon.innerHTML = '';
            /**
             * cas ou le type choisi n'est pas le choix pas défaut
             */
            if(selectType.value!=0){
                const table = document.createElement('table');
                const thead = document.createElement('thead');
                const tbody = document.createElement('tbody');

                thead.innerHTML = '<tr><th>Nom</th><th>Taille</th><th>Poids</th></tr>';
                table.appendChild(thead);
                pokemons.forEach(function(pokemon) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = '<td>' + pokemon.nom + '</td><td>' + pokemon.taille + '</td><td>' + pokemon.poids + '</td>';
                    tbody.appendChild(tr);
                });

                table.appendChild(tbody);
                divPokemon.appendChild(table);
            }
        })
        .catch(function(error) {
            console.log(error);
        });
});