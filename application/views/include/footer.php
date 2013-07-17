<footer class="footer">
    <ul class="footer_nav clearfix">
        <li><a href="<?php echo base_url(); ?>" title="">Rechercher un trajet</a></li>
        <li><a href="<?php echo base_url().'annonce/ajouter'; ?>" title="">Ajouter une annonce</a></li>
        <?php 
            echo (!$this->session->userdata('logged_in'))?  
            '<li><a href="'.base_url().'inscription">Inscription</a></li>
             <li><a href="#">Connexion</a></li>   ': 
            '<li><a href="'.base_url().'user/profil/'.$this->session->userdata('logged_in')->user_id.'">Mon profil</a></li>' 
        ?>
        <li><a href="#">Conditions générales</a></li>
        <li><a href="#">Contact&nbsp;-&nbsp;Service Client</a></li>
    </ul>
    <div class="footer_villes clearfix">
        <h4>Villes de départ courantes</h4>
        <ul class="clearfix">
            <li><a href="#">Bruxelles</a> - </li>
            <li><a href="#">Liège</a> - </li>
            <li><a href="#">Uccle</a> - </li>
            <li><a href="#">Ixelles</a> - </li>
            <li><a href="#">Namur</a> - </li>
            <li><a href="#">Charleroi</a> - </li>
            <li><a href="#">Mons</a> - </li>
            <li><a href="#">Arlon</a> - </li>
            <li><a href="#">Saint-Gilles</a> - </li>
            <li><a href="#">Hotton</a> - </li>
            <li><a href="#">Nivelles</a> - </li>
            <li><a href="#">Etterbeek</a> - </li>
            <li><a href="#">Anderlecht</a> - </li>
            <li><a href="#">Dour</a> - </li>
            <li><a href="#">Louvain-La-Neuve</a></li>
        </ul>
        <h4>Villes de destination courantes</h4>
        <ul class="clearfix">
            <li><a href="#">Bruxelles</a> - </li>
            <li><a href="#">Liège</a> - </li>
            <li><a href="#">Uccle</a> - </li>
            <li><a href="#">Ixelles</a> - </li>
            <li><a href="#">Namur</a> - </li>
            <li><a href="#">Charleroi</a> - </li>
            <li><a href="#">Mons</a> - </li>
            <li><a href="#">Arlon</a> - </li>
            <li><a href="#">Saint-Gilles</a> - </li>
            <li><a href="#">Hotton</a> - </li>
            <li><a href="#">Nivelles</a> - </li>
            <li><a href="#">Etterbeek</a> - </li>
            <li><a href="#">Anderlecht</a> - </li>
            <li><a href="#">Dour</a> - </li>
            <li><a href="#">Louvain-La-Neuve</a></li>
        </ul>
    </div>
</footer>
