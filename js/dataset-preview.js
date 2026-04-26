document.addEventListener('DOMContentLoaded', function() {
	const previewButtons = document.querySelectorAll('.btn-preview');
	const previewContainer = document.getElementById('dataset-preview-container');
	const summaryContainer = document.getElementById('dataset-column-summary');

	previewButtons.forEach(btn => {
		btn.addEventListener('click', async function(e) {
			e.preventDefault();
			const url = this.getAttribute('data-url');
			if (!url) return;

			const isXlsx = url.toLowerCase().endsWith('.xlsx') || url.toLowerCase().indexOf('.xlsx') !== -1;
			
			previewContainer.innerHTML = '<div style="padding:2rem; text-align:center;"><i class="fa-solid fa-circle-notch fa-spin fa-2x"></i><p>Lendo dados' + (isXlsx ? ' (arquivos Excel podem demorar uns segundos...)' : '') + '</p></div>';
			
			if (isXlsx) {
				try {
					const response = await fetch(url);
					const arrayBuffer = await response.arrayBuffer();
					const workbook = XLSX.read(arrayBuffer, {type: 'array'});
					const firstSheetName = workbook.SheetNames[0];
					const worksheet = workbook.Sheets[firstSheetName];
					
					// Converte para um array de arrays
					const json = XLSX.utils.sheet_to_json(worksheet, {header: 1, blankrows: false});
					
					if (json.length > 0) {
						// A primeira linha são os campos
						const fields = json[0];
						const dataRows = json.slice(1, 11); // Pega no máximo 10 linhas
						
						// Formata para o mesmo padrão do PapaParse (array de objetos)
						const formattedData = dataRows.map(row => {
							let obj = {};
							fields.forEach((field, i) => {
								obj[field] = row[i];
							});
							return obj;
						});
						
						renderPreviewTable(formattedData, fields);
						renderColumnSummary(formattedData, fields);
					} else {
						previewContainer.innerHTML = '<p>O arquivo Excel está vazio.</p>';
					}
				} catch (err) {
					console.error(err);
					previewContainer.innerHTML = '<p>Erro ao ler o arquivo XLSX.</p>';
				}
			} else {
				// Usa PapaParse para CSV
				Papa.parse(url, {
					download: true,
					header: true,
					preview: 10,
					skipEmptyLines: true,
					complete: function(results) {
						if (results.data && results.data.length > 0) {
							renderPreviewTable(results.data, results.meta.fields);
							renderColumnSummary(results.data, results.meta.fields);
						} else {
							previewContainer.innerHTML = '<p>Não foi possível carregar os dados ou o arquivo está vazio.</p>';
						}
					},
					error: function(err) {
						previewContainer.innerHTML = '<p>Erro ao ler o arquivo CSV. Verifique se é realmente um arquivo de texto válido.</p>';
					}
				});
			}
		});
	});

	function renderPreviewTable(data, fields) {
		if (!fields) return;
		
		let html = '<div style="margin-bottom:2rem;">';
		html += '<h3 style="margin-bottom:1rem;">Pré-visualização (máx 10 linhas)</h3>';
		html += '<div class="table-responsive" style="overflow-x:auto; border:1px solid rgba(0,0,0,0.1); border-radius:8px;">';
		html += '<table style="width:100%; border-collapse:collapse; font-size:0.85rem; background:#fff; text-align:left;">';
		
		html += '<thead style="background:#f5f5f5;"><tr>';
		fields.forEach(field => {
			html += `<th style="padding:.75rem; border-bottom:2px solid #ddd; border-right:1px solid #eee; white-space:nowrap;">${field || '-'}</th>`;
		});
		html += '</tr></thead>';
		
		html += '<tbody>';
		data.forEach(row => {
			html += '<tr>';
			fields.forEach(field => {
				html += `<td style="padding:.5rem .75rem; border-bottom:1px solid #eee; border-right:1px solid #eee; white-space:nowrap;">${row[field] !== undefined ? row[field] : ''}</td>`;
			});
			html += '</tr>';
		});
		html += '</tbody></table></div></div>';
		
		previewContainer.innerHTML = html;
	}

	function renderColumnSummary(data, fields) {
		if (!fields || data.length === 0) return;
		
		let types = { String: 0, Decimal: 0, Integer: 0, Other: 0 };
		
		// Infere os tipos usando a primeira linha
		const firstRow = data[0];
		fields.forEach(field => {
			const val = firstRow[field];
			if (val === null || val === undefined || val === '') {
				types.Other++;
			} else if (!isNaN(val) && String(val).trim() !== '') {
				if (String(val).indexOf('.') !== -1 || String(val).indexOf(',') !== -1) {
					types.Decimal++;
				} else {
					types.Integer++;
				}
			} else {
				types.String++;
			}
		});
		
		let html = `<li style="margin-top:1rem; border-top:1px solid rgba(0,0,0,0.05); padding-top:1rem;">`;
		html += `<i class="fa-solid fa-table-columns"></i> <strong>${fields.length} colunas</strong>`;
		html += `<ul class="dataset-summary-formats" style="margin-top:.5rem; padding-right:1rem;">`;
		if(types.String > 0) html += `<li><span style="display:inline-block; width:20px; text-align:center;">A</span> String <strong style="float:right;">${types.String}</strong></li>`;
		if(types.Decimal > 0) html += `<li><span style="display:inline-block; width:20px; text-align:center;">#</span> Decimal <strong style="float:right;">${types.Decimal}</strong></li>`;
		if(types.Integer > 0) html += `<li><span style="display:inline-block; width:20px; text-align:center;">#</span> Integer <strong style="float:right;">${types.Integer}</strong></li>`;
		if(types.Other > 0) html += `<li><span style="display:inline-block; width:20px; text-align:center;">?</span> Other <strong style="float:right;">${types.Other}</strong></li>`;
		html += `</ul></li>`;
		
		summaryContainer.innerHTML = html;
	}
});
