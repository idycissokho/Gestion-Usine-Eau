import { functions } from 'lodash';
import './bootstrap';
// import '../css/styles.min.css';
document.addEventListener('DOMContentLoaded', function(){
    const tableaudebord = document.getElementById('tableaudebord');
    const principale = document.getElementById('principale');
    const formulaire_produit = document.getElementById('formulaire_finish');
    const formulaire_depense = document.getElementById('formulaire_depense');
    const formulaire_pro = document.getElementById('formulaire_pro');
    const entrer = document.getElementById('entrer');
    const depense = document.getElementById('depense');
    const paiement = document.getElementById('paiement');
    const autre = document.getElementById('autre');
    const acceuil = document.getElementById('acceuil');
    const indisponible = document.getElementById('indisponible');
    const entrer_produit = document.getElementById('entrer_produit');
    const form_stock = document.getElementById('form_stock');
    const day_now = document.getElementById('day_now');
    const btn_performe = document.getElementById('btn_performe');
    const btn_firme = document.getElementById('btn_firme');
    const btn_etiquette = document.getElementById('btn_etiquette');
    const btn_bouchon = document.getElementById('btn_bouchon');
    const table_day = document.getElementById('table_day');
    const table_performe = document.getElementById('table_performe');
    const table_firme = document.getElementById('table_firme');
    const table_etiquette = document.getElementById('table_etiquette');
    const table_bouchon = document.getElementById('table_bouchon');
    const go_produit = document.getElementById('go_produit');
    const go_produit_stock = document.getElementById('go_produit_stock');
    const go_paiment = document.getElementById('go_paiment');
    const tableau_day = document.getElementById('tableau_day');
    const magasin = document.getElementById('magasin');
    const formulaire_stock = document.getElementById('formulaire_stock');
    const tableau_stock = document.getElementById('tableau_stock');
    const mon_stock = document.getElementById('mon_stock');
    const get_info = document.querySelectorAll('.modifier_stock');
    const view_table_prix_unitaire = document.getElementById('prix_unitaire');
    const table_type = document.getElementById('table_type');
    const ferme_type = document.getElementById('ferme_type');
    const formulaire_type = document.getElementById('formulaire_type');
    const modifier_type = document.querySelectorAll('.modifier_type');
    const table_all_stock = document.getElementById('table_all_stock');
    const ferme_unitaire = document.getElementById('ferme_unitaire');
    const view_produit_final = document.getElementById('view_produit_final');
    const btn_final_produit = document.getElementById('btn_final_produit');
    const view_preforme = document.getElementById('view_preforme');
    const view_firm = document.getElementById('view_firm');
    const view_etiquette = document.getElementById('view_etiquette');
    const view_bouchon = document.getElementById('view_bouchon');
    const fermer_finish = document.getElementById('afficher_formu_prod');
    const ferme_afficher_formu_prod = document.getElementById('ferme_afficher_formu_prod');
    const view_all_stock_finish = document.getElementById('view_all_stock_finish');
    const table_all_stock_last = document.getElementById('table_all_stock_last');
    const budjet = document.getElementById('budjet');
    const afficher_formu_depense = document.getElementById('afficher_formu_depense');
    const ferme_afficher_formu_depense = document.getElementById('ferme_afficher_formu_depense');
    const view_tab_depense = document.getElementById('view_tab_depense');
    const table_all_depense = document.getElementById('table_all_depense');
    const utilisateur = document.getElementById('utilisateur');
    const view_user = document.getElementById('view_user');




    function View_all_details()
    {
        const url = '/get_all_time';
        fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('error');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('total_today_win_performe').textContent = data.total_today_win_performe + '  preformes';
            document.getElementById('total_today_win_firme').textContent = data.total_today_win_firme + '  firms';
            document.getElementById('total_today_win_etiquette').textContent = data.total_today_win_etiquette + '  etiquettes';
            document.getElementById('total_today_win_bouchon').textContent = data.total_today_win_bouchon + '  bouchon';

            document.getElementById('total_today_prix_performe').textContent = data.total_today_prix_performe + '  CFA';
            document.getElementById('total_today_prix_firme').textContent = data.total_today_prix_firme + '  CFA';
            document.getElementById('total_today_prix_etiquette').textContent = data.total_today_prix_etiquette + '  CFA';
            document.getElementById('total_today_prix_bouchon').textContent = data.total_today_prix_bouchon + '  CFA';

            document.getElementById('preforme_for_month').textContent = data.preforme_for_month + '  CFA';
            document.getElementById('firm_for_month').textContent = data.firm_for_month + '  CFA';
            document.getElementById('etiquette_for_month').textContent = data.etiquette_for_month + '  CFA';
            document.getElementById('bouchon_for_month').textContent = data.bouchon_for_month + '  CFA';
            document.getElementById('total_prix_depense').textContent = data.total_prix_depense + '  CFA';
            document.getElementById('all_prix_depense_today').textContent = data.all_prix_depense_today + '  CFA';
            document.getElementById('all_prix_depense_month').textContent = data.all_prix_depense_month + '  CFA';
            document.getElementById('all_prix_depense_week').textContent = data.all_prix_depense_week + '  CFA';
            document.getElementById('all_prix_depense_week_resume').textContent = data.all_prix_depense_week + '  CFA';
            document.getElementById('all_prix_depense_month_resume').textContent = data.all_prix_depense_month + '  CFA';


            let depense_total_par_mois = parseFloat(data.for_month) + parseFloat(data.all_prix_depense_month);
            let depense_total_par_semaine = parseFloat(data.for_week) + parseFloat(data.all_prix_depense_week);



            document.getElementById('for_month').textContent =  depense_total_par_mois + '  CFA';

            document.getElementById('for_week').textContent = depense_total_par_semaine + '  CFA';


            document.getElementById('totalPrix_all_type_week').textContent = data.for_week + '  CFA';
            document.getElementById('totalPrix_all_type_month').textContent = data.for_month + '  CFA';

            document.getElementById('totalPrix_depense_type_week').textContent = data.all_prix_depense_week + '  CFA';
            document.getElementById('totalPrix_depense_type_month').textContent = data.all_prix_depense_month + '  CFA';




            document.getElementById('prix_produit_finish_week').textContent = data.prix_produit_finish_week + '  CFA';
            document.getElementById('prix_produit_finish_month').textContent = data.prix_produit_finish_month + '  CFA';




            document.getElementById('benefice_produit_week').textContent = data.benefice_produit_week + '  CFA';
            document.getElementById('benefice_produit_month').textContent = data.benefice_produit_month + '  CFA';















        })
    }
    View_all_details();
    function ProductionTotals()
    {
        const url = '/ProductionTotals';
        fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('error');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('totalByDay').textContent = data.totalByDay + '  packets';
            document.getElementById('totalByWeek').textContent = data.totalByWeek + '  packets';
            document.getElementById('totalByMonth').textContent = data.totalByMonth + '  packets';


            document.getElementById('totalByDayprix').textContent = data.totalByDayprix + '  CFA';
            document.getElementById('totalByWeekprix').textContent = data.totalByWeekprix + '  CFA';
            document.getElementById('totalByMonthprix').textContent = data.totalByMonthprix + '  CFA';


            document.getElementById('totalPrix_preforme_week').textContent = data.totalPrix_preforme_week + '  CFA';
            document.getElementById('totalPrix_firm_week').textContent = data.totalPrix_firm_week + '  CFA';
            document.getElementById('totalPrix_etiquette_week').textContent = data.totalPrix_etiquette_week + '  CFA';
            document.getElementById('totalPrix_bouchon_week').textContent = data.totalPrix_bouchon_week + '  CFA';






        })
    }
    ProductionTotals();





    tableaudebord.addEventListener('click', function () {
        acceuil.classList.remove('d-none');
        magasin.classList.add('d-none');
        indisponible.classList.add('d-none');
        entrer_produit.classList.add('d-none');
        view_user.classList.add('d-none');
    })
    mon_stock.addEventListener('click', function(){
        acceuil.classList.add('d-none');
        magasin.classList.remove('d-none');
        indisponible.classList.add('d-none');
        entrer_produit.classList.add('d-none');
        view_user.classList.add('d-none');

    })
    entrer.addEventListener('click', function(){
        acceuil.classList.add('d-none');
        magasin.classList.add('d-none');
        indisponible.classList.add('d-none');
        view_user.classList.add('d-none');
        entrer_produit.classList.remove('d-none');
    })
    depense.addEventListener('click', function(){
        acceuil.classList.add('d-none');
        magasin.classList.add('d-none');
        indisponible.classList.remove('d-none');
        view_user.classList.add('d-none');
        entrer_produit.classList.add('d-none');
    })
    go_paiment.addEventListener('click', function(){
        acceuil.classList.add('d-none');
        magasin.classList.add('d-none');
        indisponible.classList.remove('d-none');
        view_user.classList.add('d-none');
        entrer_produit.classList.add('d-none');
    })
    utilisateur.addEventListener('click', function(){
        acceuil.classList.add('d-none');
        magasin.classList.add('d-none');
        indisponible.classList.add('d-none');
        view_user.classList.remove('d-none');
        entrer_produit.classList.add('d-none');
    })



    get_info.forEach(button => {
        button.addEventListener('click', function(){
            table_all_stock.classList.add('d-none');
            formulaire_stock.classList.remove('d-none');
            console.log(button.getAttribute('data-id'));
            console.log(button.getAttribute('data-type'));
            document.getElementById('nombre').value = button.getAttribute('data-nombre');
            document.getElementById('type').value = button.getAttribute('data-type-id');
            document.getElementById('product_id').value = button.getAttribute('data-id');
        });
    });
    document.getElementById('ferme').addEventListener('click', function () {
        formulaire_stock.classList.add('d-none');
        table_all_stock.classList.remove('d-none');
    })
    // go_produit.addEventListener('click', function(){
    //     principale.classList.remove('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     acceuil.classList.add('d-none');
    //     indisponible.classList.add('d-none');
    //     magasin.classList.add('d-none');
    // })
    fermer_finish.addEventListener('click', function () {
        formulaire_produit.classList.remove('d-none');
        fermer_finish.classList.add('d-none');
    })
    ferme_afficher_formu_prod.addEventListener('click', function(){
        formulaire_produit.classList.add('d-none');
        fermer_finish.classList.remove('d-none');
    })
    // entrer.addEventListener('click', function(){
    //     acceuil.classList.add('d-none');
    //     principale.classList.remove('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     indisponible.classList.add('d-none');
    //     magasin.classList.add('d-none');
    // })
    // depense.addEventListener('click', function(){
    //     acceuil.classList.add('d-none');
    //     principale.classList.add('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     indisponible.classList.remove('d-none');
    //     magasin.classList.add('d-none');

    // })
    // go_depense.addEventListener('click', function(){
    //     acceuil.classList.add('d-none');
    //     principale.classList.add('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     indisponible.classList.remove('d-none');
    //     magasin.classList.add('d-none');

    // })
    // go_paiment.addEventListener('click', function(){
    //     acceuil.classList.add('d-none');
    //     principale.classList.add('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     indisponible.classList.remove('d-none');
    //     magasin.classList.add('d-none');

    // })
    // formulaire_depense.addEventListener('click', function(){
    //     acceuil.classList.add('d-none');
    //     principale.classList.add('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     indisponible.classList.remove('d-none');
    //     magasin.classList.add('d-none');

    // })
    // paiement.addEventListener('click', function(){
    //     acceuil.classList.add('d-none');
    //     principale.classList.add('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     indisponible.classList.remove('d-none');
    //     magasin.classList.add('d-none');

    // })
    // autre.addEventListener('click', function(){
    //     acceuil.classList.add('d-none');
    //     principale.classList.add('d-none');
    //     formulaire_pro.classList.add('d-none');
    //     indisponible.classList.remove('d-none');
    //     magasin.classList.add('d-none');

    // })
    // modifier_stock.addEventListener('click', function(){
    //     formulaire_stock.classList.remove('d-none');
    // })

    view_table_prix_unitaire.addEventListener('click', function(){
        console.log('cv bien')
        table_type.classList.remove('d-none');
        view_table_prix_unitaire.classList.add('d-none');
        table_all_stock.classList.add('d-none');
        formulaire_stock.classList.add('d-none');
    })
    ferme_type.addEventListener('click', function(){
        table_type.classList.add('d-none');
        view_table_prix_unitaire.classList.remove('d-none');
        table_all_stock.classList.remove('d-none');
    })
    ferme_unitaire.addEventListener('click', function(){
        table_type.classList.remove('d-none');
        view_table_prix_unitaire.classList.add('d-none');
        table_all_stock.classList.add('d-none');
        formulaire_type.classList.add('d-none');

    })
    modifier_type.forEach(button => {

        button.addEventListener('click', function(){
            table_type.classList.add('d-none');
            formulaire_type.classList.remove('d-none');
            const id = button.getAttribute('data-id');
            const prix_uni = button.getAttribute('data-prix_uni');
            const type = button.getAttribute('data-type');


            document.getElementById('id').value = id;
            document.getElementById('prix_uni').value = prix_uni;
            document.getElementById('type_type').value = id;
        })
    })



   // Fonction pour obtenir le début et la fin de la semaine
    function getWeekPeriod(date) {
        const startDate = new Date(date);
        const endDate = new Date(date);

        // Calculer le début de la semaine (lundi)
        startDate.setDate(startDate.getDate() - (startDate.getDay() === 0 ? 6 : startDate.getDay() - 1));

        // Calculer la fin de la semaine (dimanche)
        endDate.setDate(endDate.getDate() + (7 - endDate.getDay()));

        // Obtenir le format souhaité
        const startDay = String(startDate.getDate()).padStart(2, '0'); // Jour de début
        const startMonth = String(startDate.getMonth() + 1).padStart(2, '0'); // Mois de début
        const endDay = String(endDate.getDate()).padStart(2, '0'); // Jour de fin
        const endMonth = String(endDate.getMonth() + 1).padStart(2, '0'); // Mois de fin

        return `${startDay}-${endDay}`; // Retourner le format "01-07" ou "08-13"
    }

    // form_stock.addEventListener('submit', function(){
    //     event.preventDefault();
    //     var data_prod = new FormData(form_stock);
    //     const url = '/dashbord'
    //     fetch(url, {
    //         method : 'POST',
    //         headers : {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //         },
    //         body : data_prod,
    //     })
    //     .then(Response => Response.json())
    //     .then(data => {


    //         if (data.success) {
    //             alert('Stock mis a jour avec succees');
    //             formulaire_stock.classList.add('d-none');
    //             // window.location.href = '/dashbord';
    //             // $('.alert-success').text(data.enregistrer).addClass('show'); // Utilisez data.enregistrer ici


    //             const url = '/dashbord/view';
    //             fetch(url)
    //             .then(Response => {
    //                 if (!Response.ok) {
    //                     throw new Error(`Erreur HTTP ! status : ${Response.status}`);
    //                 }
    //                 return Response.json();
    //             })
    //             .then(all_stock => {
    //                 tableau_stock.innerHTML = '';
    //                 all_stock.forEach((produit, index) => {
    //                     const row = document.createElement('tr');
    //                     let createdAt = new Date(produit.created_at);
    //                     let weekPeriod = getWeekPeriod(createdAt);
    //                     let options = { weekday: 'long', month: 'long' };
    //                     let formattedDate = createdAt.toLocaleDateString('fr-FR', options);
    //                     row.innerHTML = `
    //                                     <td class="text-center fw-medium">${formattedDate.split(' ')[0]}</td>
    //                                     <td class="text-center fw-medium">${weekPeriod}</td>
    //                                     <td class="text-center fw-medium">${formattedDate.split(' ')[1]}</td>
    //                                     <td class="text-center fw-medium">${ produit.type ? produit.type.type : "Inconnue" }</td>
    //                                     <td class="text-center fw-medium">${ produit.nombre }</td>
    //                     `;
    //                     if (tableau_day.appendChild(row)) {
    //                         console.log('sa marche');
    //                         // document.getElementById('totalValue').textContent = prix_total;
    //                     }else{
    //                         console.log('sa ne vas pas');
    //                     }

    //                 });
    //             })
    //         }
    //     })
    // })

    // day_now.addEventListener('click', function(){
    //     table_day.classList.remove('d-none');
    //     table_performe.classList.add('d-none');
    //     table_firme.classList.add('d-none');
    //     table_etiquette.classList.add('d-none');
    //     table_bouchon.classList.add('d-none');

    // })
    // btn_performe.addEventListener('click', function(){
    //     table_day.classList.add('d-none');
    //     table_performe.classList.remove('d-none');
    //     table_firme.classList.add('d-none');
    //     table_etiquette.classList.add('d-none');
    //     table_bouchon.classList.add('d-none');

    // })
    // btn_firme.addEventListener('click', function(){
    //     table_day.classList.add('d-none');
    //     table_performe.classList.add('d-none');
    //     table_etiquette.classList.add('d-none');
    //     table_firme.classList.remove('d-none');
    //     table_bouchon.classList.add('d-none');

    // })
    // btn_etiquette.addEventListener('click', function(){
    //     table_day.classList.add('d-none');
    //     table_performe.classList.add('d-none');
    //     table_firme.classList.add('d-none');
    //     table_etiquette.classList.remove('d-none');
    //     table_bouchon.classList.add('d-none');

    // })
    // btn_bouchon.addEventListener('click', function(){
    //     table_day.classList.add('d-none');
    //     table_performe.classList.add('d-none');
    //     table_firme.classList.add('d-none');
    //     table_etiquette.classList.add('d-none');
    //     table_bouchon.classList.remove('d-none');
    // })




    btn_final_produit.addEventListener('click', function(){
        view_produit_final.classList.remove('d-none');
        view_preforme.classList.add('d-none');
        view_firm.classList.add('d-none');
        view_etiquette.classList.add('d-none');
        view_bouchon.classList.add('d-none');
    })
    btn_performe.addEventListener('click', function(){
        view_produit_final.classList.add('d-none');
        view_preforme.classList.remove('d-none');
        view_etiquette.classList.add('d-none');
        view_firm.classList.add('d-none');
        view_bouchon.classList.add('d-none');
    })
    btn_firme.addEventListener('click', function(){
        view_produit_final.classList.add('d-none');
        view_preforme.classList.add('d-none');
        view_firm.classList.remove('d-none');
        view_bouchon.classList.add('d-none');
        view_etiquette.classList.add('d-none');
    })
    btn_etiquette.addEventListener('click', function(){
        view_produit_final.classList.add('d-none');
        view_preforme.classList.add('d-none');
        view_firm.classList.add('d-none');
        view_bouchon.classList.add('d-none');
        view_etiquette.classList.remove('d-none');
    })
    btn_bouchon.addEventListener('click', function(){
        view_produit_final.classList.add('d-none');
        view_preforme.classList.add('d-none');
        view_firm.classList.add('d-none');
        view_bouchon.classList.remove('d-none');
        view_etiquette.classList.add('d-none');
    })
    view_all_stock_finish.addEventListener('click', function(){
        table_all_stock_last.classList.remove('d-none');
    })
    go_produit.addEventListener('click', function(){
        magasin.classList.remove('d-none');
        acceuil.classList.add('d-none');
    })
    go_produit_stock.addEventListener('click', function(){
        magasin.classList.add('d-none');
        acceuil.classList.add('d-none');
        entrer_produit.classList.remove('d-none');
    })
    // budjet.addEventListener('click', function() {
    //     console.log('sa marche')
    //     let budgetModal = new bootstrap.Modal(document.getElementById('budgetModal'));
    //     budgetModal.show();
    // });
    afficher_formu_depense.addEventListener('click', function(){
        formulaire_depense.classList.remove('d-none');
    })
    ferme_afficher_formu_depense.addEventListener('click', function(){
        formulaire_depense.classList.add('d-none');
    })
    view_tab_depense.addEventListener('click', function(){
        table_all_depense.classList.remove('d-none');
    })



});

