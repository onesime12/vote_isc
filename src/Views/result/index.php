<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 vote-list">
            <h4 class="p-3">Liste des élections</h4>
            <ul class="list-group">
                <li class="list-group-item election-item" onclick="showDetails('Election 1')">Élection présidentielle 2024</li>
                <li class="list-group-item election-item" onclick="showDetails('Election 2')">Élections municipales 2023</li>
                <li class="list-group-item election-item" onclick="showDetails('Election 3')">Élections législatives 2022</li>
            </ul>
        </div>

        <div class="col-md-8 vote-details">
            <h4 id="electionTitle">Sélectionnez une élection pour voir les détails</h4>
            <div id="electionDetails">
                <p>Cliquez sur une élection à gauche pour afficher plus d'informations ici.</p>
            </div>
        </div>
    </div>
</div>