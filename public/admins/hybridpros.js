function RegisterCustomer(route, load, logging){
    let validity = 0;dddd

    validity += Supp.check('customer_name', 'customer_name_e');
    validity += Supp.check('select_plan', 'select_plan_e');

    if(validity === 2){
        document.getElementById('roller').style.display='flex';
        $.ajax({
           type: "post",
           url: route,
           data: $('form#customerRegistration').serialize(),
           success: res => {
            document.getElementById('roller').style.display='none';
            console.log(res);
            document.getElementById('closeRegisterModal').click();
            LoadCustomer(load, logging);
           }, error: xhr => console.log(xhr.responseText),
        });
    }
}

function LoadCustomer(route, logging){
    $.ajax({
        type: "get",
        url: route,
        dataType: "json",
        success: res=> {
         const data = res.hp;
         Customers(data, logging, route);
        },error: xhr => console.log(xhr.responseText)
    });
}
function Customers(data, logging, load){
    const list = document.getElementById('customerList');
    list.innerHTML = '';

    data.forEach(d => {
       let active = ``;
       const timeSplit = d.remaining_time.split(':');
       if(d.historyActive != 'none'){
       d.historyActive.forEach(ha=>{
           active += `<tr>
           <td>${ha.act}</td>
           <td>${ha.hp_plan_start}</td>
           <td>${ha.hp_plan_expire_new != null?
           '<s>'+ha.hp_plan_expire+'</s><br>' + ha.hp_plan_expire_new : ha.hp_plan_expire}</td>
           <td>${ha.hp_remaining_time}</td>
           <td>${ha.hp_consume_time}</td>
           <td>${ha.price == 0 ? 'Free' :  `₱${ha.price}`}</td>
           <td><span class="badge text-bg-success p-2"> Active </span></td>
           <td><button onclick="OpenPlanEdit('${ha.hph_id}', '${ha.act}', '${ha.hp_plan_start}', '${ha.hp_plan_expire}', '${ha.hp_remaining_time}', '1', '${d.hp_id}')"
            data-bs-toggle="modal" data-bs-target="#editCustomerPlan" class="btn btn-outline-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
</svg>  </button></td>
           </tr>`;
        });

     }
     if(d.historyPending != 'none'){
       active += `<tr>
       <td>${d.historyPending.name}</td>
       <td>${d.historyPending.hp_plan_start}</td>
       <td>${d.historyPending.hp_plan_expire}</td>
       <td>${d.historyPending.hp_remaining_time}</td>
       <td>${d.history.hp_consume_time}</td>
       <td>${d.historyPending.price == 0 ? 'Free' : `₱${d.historyPending.price}`}</td>
       <td><span class="badge text-bg-warning p-2"> Pending  </span></td>
       <td><button onclick="OpenPlanEdit('${d.historyPending.hph_id}','${d.historyPending.name}', '${d.historyPending.hp_plan_start}', '${d.historyPending.hp_plan_expire}', '${d.historyPending.hp_remaining_time}', '0')"
        data-bs-toggle="modal" data-bs-target="#editCustomerPlan" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
</svg> </button></td>
       </tr>`;
     }


      d.inuse == 1 ? startTimer(d.hp_id, timeSplit[0], timeSplit[1]) : startTimer(d.hp_id, 0, 0);
      list.innerHTML += ` <div class="accordion-item" id="accordionCustomerList">
       <h2 class="accordion-header">
       <button class="accordion-button bg-${d.active === 1 ? 'success' : d.payment === 1 ? 'danger' : 'warning'}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${d.hp_id}" aria-expanded="true" aria-controls="collapse${d.hp_id}">
      <div class="d-flex w-100 justify-content-between">
      <div> ${d.hp_customer_name} &nbsp; <span class="badge text-bg-info">${d.active === 1 ? '(Active)' : d.payment === 1 ? '(Inactive) ' : '(Pending Payment)'}</span>
      <span style="display: ${d.payment === 1 ? 'none' : ''}" data-bs-toggle="modal" onclick="AcceptUpdate('${d.hp_id}', '${d.price}', '${d.name}', '${d.expiration}')" data-bs-target="#accept_payment" class="acc_btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
<path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
<path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z"/>
</svg> Accept Payment</span>
      </div>
      <div class="px-4 d-flex gap-4">
      <span>Remaining Time: <span id='timer${d.hp_id}'></span></span>
      <span class="acc_btn" data-bs-toggle="modal" onclick="OpenUpdateCustomer('${d.hp_id}', '${d.hp_customer_name}', '${d.hp_phone_number}', '${d.hp_email}')" data-bs-target="#editCustomer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
<path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
<path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
</svg> Edit Profile</span>

<span class="acc_btn"  style="display: ${d.payment === 1 ? '' : 'none'}" onclick="OpenNewPlan('${d.hp_customer_name}', '${d.hp_id}')"  data-bs-toggle="modal" data-bs-target="#buyNewPlan"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
<path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
</svg> Buy New Plan</span>
<span onclick="HybridLogging('${logging}', '${d.hp_id}', '${load}', '${d.inuse === 1 ?  '0' : '1'}')"
style="display: ${d.active === 1 ?  '' : 'none'}"
class="badge text-bg-${d.inuse === 1 ?  'danger' : 'primary'} p-2">${d.inuse === 1 ?  'Logout' : 'Login'}</span></div>
      </div>
     </button>
   </h2>
    <div id="collapse${d.hp_id}" class="accordion-collapse collapse" data-bs-parent="#customerList">
 <div class="accordion-body">
   <table class="table table-striped" style="width:100%">
       <thead>
       <tr>
       <th>Plan</th>
       <th>Date Purchased</th>
       <th>Date Expired</th>
       <th>Remaining Time</th>
       <th>Consume Time</th>
       <th>Price</th>
       <th>Status</th>
       <th>Action</th>
       </tr>
       </thead>
       <tbody>
         ${active}
       </tbody>
       </table>
       <div class="d-flex w-100 justify-content-end">
       <a data-bs-toggle="modal" data-bs-target="#viewAllHistory" onclick="ShowCustomerHistory('${d.hp_id}')" href="javascript:void()">See All History</a>
       </div>
 </div>
</div>
</div>`;
     });
}

let tableHistory;
function ShowCustomerHistory(id){
   const API = document.getElementById('customerHistoryAPI').value;

   const route = `${API}?id=${id}`;

   $.ajax({
    type: "GET",
    url:route,
    dataType: "json",
    success: res=>{
        if (!$.fn.DataTable.isDataTable('#customerHistory')) {
            tableHistory = $('#customerHistory').DataTable({
                data: res.history,
                columns: [

                    { title: "Plan", data: null,
                        render: data => {
                            return data.hp_transfer_status == 1 ? `<s>${data.plan_name}</s>(Transferred)` : data.hp_transfer_status == 2 ? `${data.plan_name}(Recieved)` : data.plan_name
                        }
                     },
                    { title: "Date Purchased", data: null,
                        render: data => {
                            return data.hp_transfer_status == 1 ? `<s>${data.hp_plan_start}</s>(Transferred)` : data.hp_transfer_status == 2 ? `${data.hp_plan_start}(Recieved)` : data.hp_plan_start
                        }
                     },
                    { title: "Date Expired", data: null,
                        render: data=> {
                            const expiration = data.hp_plan_expire_new != null ? `<s>${data.hp_plan_expire}</s><br>${data.hp_plan_expire_new}` : data.hp_plan_expire;
                            const transfer =  `<s>${data.hp_plan_start}</s>(Transferred)`;
                            return  data.hp_transfer_status == 1 ? transfer : data.hp_transfer_status == 2 ? `${expiration}(Recieved)`:  expiration;
                        }
                    },
                    { title: "Transfer Status", data:'transfer'},
                    { title: "Status", data:null,
                        render: data=>{
                            return `${data.hp_active_status === 1 ? '<span class="badge text-bg-success p-2">Active</span>' : data.hp_payment_status === 0 ? '<span class="badge text-bg-warning p-2">Pending</span>': '<span class="badge text-bg-danger p-2">Inactive</span>'}`
                        }
                     },
                ],
                autoWidth: false
            });
        } else {
            tableHistory.clear().rows.add(res.history).draw();
        }
    }, error: xhr=>console.log(xhr.responseText)
   });
}

function HybridLogging(route, id, load, status){
  const log = status == 1 ? 'Log In' : 'Log Out';
  alertify.confirm(`Confirm ${log}`, `Are you sure you want to ${log} this customer?`,
    ()=> {
        const roller = document.getElementById('roller');
        roller.style.display = 'flex';

        document.getElementById('logging_id').value = id;
        document.getElementById('logging_status').value = status;

        $.ajax({
          type:"POST",
          url: route,
          data: $('form#logging').serialize(),
          success: res=> {
            if(res.status === 'success'){
              roller.style.display = 'none';
              LoadCustomer(load, route);
              toastr.success('Logged in Successfully');
            }
          },error: xhr =>console.log(xhr.responseText)
        });
    }, ()=> console.log('cancel')
  )
}
function SearchCustomer(route, load, logging){
   $.ajax({
    type:"POST",
    url:route,
    data: $('form#searchCustomer').serialize(),
    success: res=> {
      if(res.hp.length == 0){
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('No Data Found');
      }else{
      const data = res.hp;
      Customers(data, load, logging);
      }
    }, error: xhr => console.log(xhr.responseText)
   })
}
const timers = {};


function OpenPlanEdit(id, name, start, end, time, status, customer_id){
  const editName = document.getElementById('planEditName');
  const editStart = document.getElementById('planPurchaseDate');
  const editExpiration = document.getElementById('planExpirationDate');
  const editTimeRemaining = document.getElementById('planTimeRemaining');
  const editStatus = document.getElementById('planStatus');
  const inpEditExpiration = document.getElementById('inpPlanExpDate');
  const inpPlanTimeRemaining = document.getElementById('inpPlanTimeRemaining');

  SetActivePlan(status);
  document.getElementById('transferCustomerHPH_ID').value = id;
  document.getElementById('transferCustomerHPH_ID_radio').value = id;
  getLogHistory(id, customer_id);
  const endDate = new Date(end);
  endDate.setDate(endDate.getDate() + 1);
  const formatEndDate = endDate.toISOString().split('T')[0];
  inpEditExpiration.value = formatEndDate;
  inpPlanTimeRemaining.value = time;
  editStatus.innerHTML = '';
  editName.textContent = name;
  editStart.textContent = start;
  editExpiration.textContent = end;
  editTimeRemaining.textContent = time;

  document.getElementById('changePlanHistoryId').value = id;

  if(status == 1){
    editStatus.innerHTML = `Status: <span class="badge text-bg-success p-2">Active</span>`;
  }else{
    editStatus.innerHTML = `Status: <span class="badge text-bg-danger p-2 ">Inactive</span> `;
  }

  document.getElementById('updateHp_id').value = id;
  editStatus.innerHTML += `<svg class="ml-2 acc_btn" onclick="editAllPlanStatus()"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                  </svg>`;
}

function ChangePlan(route, load, logging){
 const roller = document.getElementById('roller');
 roller.style.display = 'flex';

 $.ajax({
   type: "POST",
   url: route,
   data: $('form#changePlanForm').serialize(),
   success: res=> {
     if(res.status == 'success'){
        roller.style.display = 'none';
        document.getElementById('changePlanClose').click();
        toastr.success('successfully change customer plan');

        LoadCustomer(load, logging)
     }
   }, error: xhr => console.log(xhr.responseText)
 });

}
function SetActivePlan(status){
  const active = document.getElementById('editStatusActive');
  const inactive = document.getElementById('editStatusInactive');

  const inp = document.getElementById('editPlanActiveStatus');
    if(status == 1){
        active.className = '';
        active.classList.add('btn', 'btn-success');
        inp.value = 1;
        inactive.className = '';
        inactive.classList.add('btn', 'btn-outline-danger');
      }else{
        active.className = '';
        active.classList.add('btn', 'btn-outline-success');
        inp.value = 0;
        inactive.className = '';
        inactive.classList.add('btn', 'btn-danger');
      }
}

function editExpDate(){
    const inpEditExpiration = document.getElementById('inpPlanExpDate');
    if(inpEditExpiration.type === 'hidden'){
        inpEditExpiration.type = 'date';
      }else{
        inpEditExpiration.type = 'hidden';
      }
}

function editTimeRemaining(){
    const inpPlanTimeRemaining = document.getElementById('inpPlanTimeRemaining');
    if(inpPlanTimeRemaining.type === 'hidden'){
        inpPlanTimeRemaining.type = 'text';
      }else{
        inpPlanTimeRemaining.type = 'hidden';
      }
}
function updateDisplay(timerId, hours, minutes, seconds) {
    document.getElementById(`timer${timerId}`).textContent =
        `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

function OpenNewPlan(name, id){
 document.getElementById('customerNewPlan').textContent = name;
 document.getElementById('customer_id').value = id;
}

function editAllPlanStatus(){
   const status = document.getElementById('editActiveStatus');

   if(status.style.display == 'none'){
    status.style.display = 'flex';
   }else{
    status.style.display = 'none';
   }
}
function BuyNewPlan(route, load, logging){
    const detect = document.getElementById('bunos');


    if(detect.value == 0){
      toastr.error('Please select a plan before submitting');
    }else if(detect.value == 9){
        const date = document.getElementById('bunosExpDate');
        const hours = document.getElementById('bunosHours');
        const minutes = document.getElementById('bunosMinutes');

        if(date.value == '' || hours.value == '' || minutes.value == ''){
          toastr.error('Please Complete the information to proceed');
        }else{
            const roller = document.getElementById('roller');
            roller.style.display = 'flex';
            $.ajax({
                type:"POST",
                url: route,
                data: $('form#buyNewPlanForm').serialize(),
                success: res=> {
                  if(res.status === 'success'){
                    LoadCustomer(load, logging);
                    document.getElementById('closeBuyNewPlan').click();
                    roller.style.display = 'none';
                  }
                }, error: xhr => console.log(xhr.responseText)
            });
        }

    }else{
        const roller = document.getElementById('roller');
        roller.style.display = 'flex';
        $.ajax({
            type:"POST",
            url: route,
            data: $('form#buyNewPlanForm').serialize(),
            success: res=> {
              if(res.status === 'success'){
                LoadCustomer(load, logging);
                document.getElementById('closeBuyNewPlan').click();
                roller.style.display = 'none';
              }
            }, error: xhr => console.log(xhr.responseText)
        })
    }

}

function startTimer(timerId, hours, minutes) {
    clearInterval(timers[timerId]?.interval);

    let totalTime = (hours * 3600) + (minutes * 60); // Convert to total seconds

    timers[timerId] = { totalTime };

    timers[timerId].interval = setInterval(() => {
        if (timers[timerId].totalTime <= 0) {
            clearInterval(timers[timerId].interval);
            updateDisplay(timerId, 0, 0, 0);
            return;
        }

        timers[timerId].totalTime--;
        const hrs = Math.floor(timers[timerId].totalTime / 3600);
        const mins = Math.floor((timers[timerId].totalTime % 3600) / 60);
        const secs = timers[timerId].totalTime % 60;
        updateDisplay(timerId, hrs, mins, secs);
    }, 1000);
}

function stopTimer(timerId) {
    clearInterval(timers[timerId]?.interval);
}

function resetTimer(timerId) {
    clearInterval(timers[timerId]?.interval);
    timers[timerId] = { totalTime: 0 };
    updateDisplay(timerId, 0, 0, 0);
}

function AcceptUpdate(id, payment, name, expired){
 document.getElementById('hp_id').value = id;

 const ammount = document.getElementById('acceptAmmount');
 const plan = document.getElementById('acceptPlanPurchased');
 const expiration = document.getElementById('acceptExpirationDate');

 ammount.textContent = payment;
 plan.textContent = name;
 expiration.textContent = expired
}

function AcceptPayment(route, load, logging){
    const radios = document.querySelectorAll('input[name="mode"]');
    let selected = false;

    for (const radio of radios) {
        if (radio.checked) {
            selected = true;
            break;
        }
    }

    if (selected) {
        document.getElementById('roller').style.display = 'flex';
        $.ajax({
            type:"POST",
            url: route,
            data: $('form#accept_payment_form').serialize(),
            success: res=> {
                if(res.status === 'success'){
                    document.getElementById('roller').style.display = 'none';
                    document.getElementById('closeAcceptBtn').click();
                    LoadCustomer(load, logging);
                }
            }, error: xhr => console.log(xhr.responseText)
        })
    } else {
        toastr.error('No Payment Method is selected.');
    }


}
let table;

function CustomerExist(route){

    const btnExist = document.getElementById('btnExist');
    const btnNew = document.getElementById('btnNew');

    const insertExisting = document.getElementById('insertexisting');
    const insertNewCustomer = document.getElementById('insertnewcustomer');

    btnExist.style.display = 'none';
    btnNew.style.display = '';

    insertExisting.style.display = '';
    insertNewCustomer.style.display = 'none';

   $.ajax({
    type:"get",
    url: route,
    dataType: "json",
    success: res=> {
        if (!$.fn.DataTable.isDataTable('#customers')) {
            table = $('#customers').DataTable({
                data: res.cust,
                columns: [
                    { title: "Customer Name", data:null,
                        render: data => {
                            return `${data.customer_firstname} ${data.customer_middlename != null ? data.customer_middlename : ""} ${data.customer_lastname}`;
                        }
                     },
                    { title: "Contact", data: "customer_phone_num" },
                    { title: "Email", data: "customer_email" },
                    { title: "Select", data: null,
                        render: data=> {
                            const fullname = `${data.customer_firstname} ${data.customer_middlename != null ? data.customer_middlename : ""} ${data.customer_lastname}`;
                            return `<button type="button" onclick="SelectExisting('${fullname}', '${data.customer_email}', '${data.customer_phone_num}')" class="btn btn-success">Select</button>`
                        }
                    }
                ],
                autoWidth: false
            });
        } else {
            table.clear().rows.add(res.cust).draw();
        }
    }, error: xhr => console.log(xhr.responseText)
   })
}

function SelectExisting(fullname, email, contact){
 const customerName = document.getElementById('customer_name');
 const phoneNumber = document.getElementById('phoneNumber');
 const inp_email = document.getElementById('email');

 CustomerNew();

 customerName.value = fullname;
 phoneNumber.value = contact;
 inp_email.value = email;
}

function CustomerNew(){
    const btnExist = document.getElementById('btnExist');
    const btnNew = document.getElementById('btnNew');

    const insertExisting = document.getElementById('insertexisting');
    const insertNewCustomer = document.getElementById('insertnewcustomer');

    btnExist.style.display = '';
    btnNew.style.display = 'none';

    insertExisting.style.display = 'none';
    insertNewCustomer.style.display = '';

}

function OpenUpdateCustomer(id, name, contact, email){
document.getElementById('updateCustomerId').value = id;
document.getElementById('customer_name_edit').value = name;
document.getElementById('phoneNumber_edit').value = contact;
document.getElementById('email_edit').value =  email;
}

function UpdateCustomerProfile(route, load, logging){
    let validity = 0;

    validity += Supp.check('customer_name_edit', 'customer_name_edit_e');

    if(validity === 1){
        document.getElementById('roller').style.display='flex';
        $.ajax({
           type: "post",
           url: route,
           data: $('form#editCustomerForm').serialize(),
           success: res => {
            document.getElementById('roller').style.display='none';
            document.getElementById('editProfileFormClose').click();
            document.getElementById('closeRegisterModal').click();
            LoadCustomer(load, logging);
           }, error: xhr => console.log(xhr.responseText),
        });
    }
}

function SaveChangesEditPlan(route, load, logging){
   alertify.confirm('Save Changes', "Are you sure do you wanna save this changes?",
   ()=>{
     const roller = document.getElementById('roller');

     roller.style.display = 'flex';

     $.ajax({
       type:"POST",
       url: route,
       data: $('form#updatePlanForm').serialize(),
       success:res=>{
        if(res.status == 'success'){
           document.getElementById('editPlanFormClose').click();
           toastr.success('Successfully Updated the plan');
           LoadCustomer(load, logging);
           roller.style.display = 'none';
        }
       }, error: xhr=> console.log(xhr.responseText)
     });
   }, ()=> console.log('cancel')
   )
}


function DetectBunos(select){
const bunos = document.getElementById('freeBunos');
bunos.style.display = select.value == 9 ? '' : 'none';
}
let tableHistoryLogs;
let tableOtherCustomer;
function getLogHistory(id, customer_id){
 const API = document.getElementById('customerLogHistoryAPI').value;

 const route = `${API}?hph_id=${id}`;


 const customerAPI = document.getElementById('customerGetOtherAPI').value;

 const getCustomer = `${customerAPI}?hp_id=${customer_id}`;

 $.ajax({
    type:"GET",
    url:route,
    dataType: "json",
    success: res=> {
        if (!$.fn.DataTable.isDataTable('#hybridLogHistory')) {
            tableHistoryLogs = $('#hybridLogHistory').DataTable({
                data: res.hph,
                columns: [
                    { title: "Log Date", data: "log_date" },
                    { title: "Time In", data: "log_time_in" },
                    { title: "Time Out", data: 'log_time_out',},
                    { title: "Consume Time", data:"log_time_consume" },
                    { title: "Remaining Time", data:"log_time_remaining"},
                    { title: "Status", data: null,
                        render: data => {
                           const color = data.log_status == 1 ? 'danger' : 'primary';
                           const text = data.log_status == 1 ? 'Logged Out' : 'Logged In';
                           return `<span class="badge p-2 text-bg-${color}">${text}</span>`;
                        }
                    }
                ],
                autoWidth: false
            });
        } else {
            tableHistoryLogs.clear().rows.add(res.hph).draw();
        }
    },error: xhr=> console.log(xhr.responseText)
 });



 $.ajax({
    type:"GET",
    url:getCustomer,
    dataType: "json",
    success: res=> {
        if (!$.fn.DataTable.isDataTable('#transferCustomerList')) {
            tableOtherCustomer = $('#transferCustomerList').DataTable({
                data: res.customer,
                columns: [
                    { title: "Customer Name", data: "hp_customer_name" },
                    { title: "Contact Number", data: "hp_phone_number" },
                    { title: "Email", data: 'hp_email',},
                    { title: "Select", data:null,
                        render: data => {
                            return `<input onclick="detectSelection()" name="selectOtherCustomer" class="form-check-input" type="radio" value="${data.hp_id}">`
                        }
                     },
                ],
                autoWidth: false
            });
        } else {
            tableOtherCustomer.clear().rows.add(res.customer).draw();
        }
    },error: xhr=> console.log(xhr.responseText)
 });
}

function detectSelection(){
  const cancel = document.getElementById('cancelSelectionCustomer');
  cancel.style.display = '';

  const name = document.getElementById('other_customer_name');
  const contact = document.getElementById('other_phoneNumber');
  const email = document.getElementById('other_email');

  name.value = '';
  contact.value = '';
  email.value = '';
}


function RemoveSelect(){
    const radioButtons = document.getElementsByName('selectOtherCustomer');
    for (let radio of radioButtons) {
        if (radio.checked) {
            radio.checked = false;
            break;
        }
    }

    document.getElementById('cancelSelectionCustomer').style.display = 'none';
}

function SwitchTransferPlan(btn){

    const select = document.getElementById('transferPlan');
    const log = document.getElementById('viewLogs');

    if(select.style.display == 'none'){
        select.style.display = '';
        log.style.display = 'none';
        btn.textContent = 'View Logs';
    }else{
        select.style.display = 'none';
        log.style.display = '';
        btn.textContent = 'Transfer Plan';
    }
}


function TransferPlanCustomer(routeAdd, routeSelect, load, logging){
    const radioButtons = document.getElementsByName('selectOtherCustomer');
    const roller = document.getElementById('roller');
    let selectedData = 'none';

    alertify.confirm("Confirm Transfer Plan", "Are you sure about the data you inserted?",
        ()=>{
            for (let radio of radioButtons) {
                if (radio.checked) {
                    selectedData = radio.value;
                    break;
                }
            }

            if(selectedData == 'none'){
               let validity = 0;

               validity+= Supp.check('other_customer_name', 'other_customer_name_e');

               if(validity == 1){
                 roller.style.display = 'flex';

                 $.ajax({
                  type:"POST",
                  url: routeAdd,
                  data: $('form#registerTransferCustomer').serialize(),
                  success: res=> {
                    if(res.status == 'success'){
                        roller.style.display = 'none';
                        LoadCustomer(load, logging);
                    }
                  }, error: xhr=> console.log(xhr.responseText)
                 });
               }
            }else{
                document.getElementById('transferCustomer_id').value = selectedData;
                roller.style.display = 'flex';

                $.ajax({
                    type:"POST",
                    url: routeSelect,
                    data: $('form#selectedOtherCustomerForm').serialize(),
                    success: res=> {
                        if(res.status == 'success'){
                            roller.style.display = 'none';
                            LoadCustomer(load, logging);
                        }
                    }, error: xhr=> console.log(xhr.responseText)
                   });
            }

            document.getElementById('editPlanFormClose').click();
        }, ()=> console.log('cancel')
    )

}

function ClearInputs(ids){

    ids.forEach(i => {
       const input = document.getElementById(i);
       input.value = '';
    });

    const select = document.getElementById('select_plan');
    if(select){
        select.value = 0;
    }
}
