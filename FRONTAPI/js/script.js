const form = document.querySelector('#clinica')
const nomeInput = document.querySelector('#nomeInput')
const medicoInput = document.querySelector('#medicoInput')
const dataInput = document.querySelector('#dataInput')
const horaInput = document.querySelector('#horaInput')
const URL = 'http://localhost:3000/clinica.php'

const tableBody = document.querySelector('#tabela-pacientes')
console.log('teste')
function carregarClinica() {
    fetch(URL, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(response => response.json())
        .then(clinicas => {
            tableBody.innerHTML = ''

            for (let i = 0; i < clinicas.length; i++) {
                const tr = document.createElement('tr')
                const clinica = clinicas[i]
                tr.innerHTML = `
                  <td>${clinica.nome_paciente}</td>
                  <td>${clinica.medico}</td>
                  <td>${clinica.data}</td>
                  <td>${clinica.hora}</td>
                   <td> 
                  <button data-id="${clinica.id}"onclick="atualizarClinica(${clinica.id})">Editar</button>
                  <button onclick="excluirAgendamento(${clinica.id})">Excluir</button>
                 </td>
                `
                tableBody.appendChild(tr)
            }
        })
}
function adicionarClinica(event) {
    event.preventDefault()
    const nome_paciente = nomeInput.value
    const medico = medicoInput.value
    const data = dataInput.value
    const hora = horaInput.value
    fetch(URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body:
            `nome_paciente=${encodeURIComponent(nome_paciente)}&medico=${encodeURIComponent(medico)}&data=${encodeURIComponent(data)}&hora=${encodeURIComponent(hora)}`
    })
        .then(response => {
            if (response.ok) {
                carregarClinica()
                nomeInput.value = ''
                medicoInput.value = ''
                dataInput.value = ''
                horaInput.value = ''
            } else {
                console.error('Error ao add agendamento')
                alert('Erro ao Add agendamento')
             }
        })
}

function atualizarClinica(id) {
    const novoPaciente = prompt("Digite um novo nome")
    const novoMedico = prompt("Digite um novo médico")
    const novoData = prompt("Digite um novo Data")
    const novoHora = prompt("Digite um novo Horário")

    if (novoPaciente && novoMedico && novoData && novoHora) {
        fetch(`${URL}?id=${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },

            body: `nome_paciente=${encodeURIComponent(novoPaciente)}&medico=${encodeURIComponent(novoMedico)}&data=${encodeURIComponent(novoData)}&hora=${encodeURIComponent(novoHora)}`

        })

            .then(response => {
                if (response.ok) {
                    carregarClinica()
                } else {
                    console.error('Erro ao att agendamento')
                    alert('erro ao att agendamento')
                }
            })
    }
}

function excluirAgendamento(id) {
    if (confirm('Deseja excluir o seu agendamento??')) {
        fetch(`${URL}?id=${id}`, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    carregarClinica()
                } else {
                    console.error('Erro ao excluir agendamento')
                    alert('Erro ao excluir agendamento')
                }
            })
    }
}
form.addEventListener('submit',adicionarClinica)

carregarClinica()