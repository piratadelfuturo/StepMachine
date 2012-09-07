<?php $view->extend('BoomBackBundle::layout.html.php') ?>
		<div class="g12 nodrop">
			<h1>Dashboard</h1>
			<p>This is a quick overview of some features</p>
		</div>


		<div class="g6 widgets">

			<div class="widget" id="calendar_widget" data-icon="calendar">
				<h3 class="handle">Calendario</h3>
				<div>
					<div class="calendar" data-header="small">
					</div>
					<p>
					<a class="btn" href="http://9gag.com" target="_blank" >9gag</a>
					</p>
				</div>
			</div>

			<div class="widget number-widget" id="widget_number">
				<h3 class="handle">Number</h3>
				<div>
					<ul>
						<li><a href=""><span>7423</span> Total Visits</a></li>
						<li><a href=""><span>392</span> Today Visits</a></li>
						<li><a href=""><span>153</span> Unique Visits</a></li>
						<li><a href=""><span>14</span> Support Tickets</a></li>
						<li><a href=""><span>253</span> Comments</a></li>
					</ul>
				</div>
			</div>
		</div>


		<div class="g6 widgets">

            <div class="widget" id="daily-seven-widget" data-icon="google_buzz">
                <h3 class="handle">Siete diarios</h3>
                    <?php echo $view['actions']->render('BoomBackBundle:Widget:dailySeven'); ?>
            </div>

			<div class="widget" id="widget_charts" data-icon="graph">
				<h3 class="handle">Charts</h3>
				<div>
					<table class="chart" data-fill="true" data-tooltip-pattern="%1 %2 on the 2011-03-%3">
						<thead>
							<tr>
								<th></th>
								<th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th>
								<th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th><th>29</th><th>30</th><th>31</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>Total Visitors</th>
								<td>331</td><td>306</td><td>337</td><td>340</td><td>332</td><td>330</td><td>307</td><td>343</td><td>307</td><td>322</td><td>319</td><td>314</td><td>326</td><td>317</td><td>323</td><td>347</td><td>317</td><td>341</td><td>328</td><td>307</td><td>350</td><td>330</td><td>313</td><td>314</td><td>332</td><td>330</td><td>317</td><td>346</td><td>328</td><td>312</td><td>311</td>
							</tr>
							<tr>
								<th>Unique Visitors</th>
								<td>113</td><td>126</td><td>143</td><td>126</td><td>147</td><td>131</td><td>150</td><td>112</td><td>110</td><td>130</td><td>109</td><td>115</td><td>146</td><td>129</td><td>138</td><td>122</td><td>114</td><td>112</td><td>128</td><td>111</td><td>122</td><td>136</td><td>109</td><td>106</td><td>104</td><td>146</td><td>123</td><td>139</td><td>117</td><td>116</td><td>143</td>
							</tr>
						</tbody>
					</table>
					<p>
					<a class="btn" href="charts.html">Check out the Charts section</a>
					</p>
					</div>
				</div>

				<div class="widget" id="widget_info">
					<h3 class="handle">Do What you like!</h3>
					<div>
						<h3>Widgets can contain everything</h3>
						<p>
						 Widgets are flexible, dragg-, sort-, and collapseable content boxes. Fill them with some html!
						</p>
						<p>
						<a class="btn" href="widgets.html">Check out the Widget section</a>
						</p>
					</div>
				</div>

			</div>
