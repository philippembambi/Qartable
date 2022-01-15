<script>
	Vue.component('keywordcounter', {
		template: '#keywordcounter-template',
		props: {
			data: Array,
			columns: Array
		},
		data: function () {
			var sortOrders = {};
			this.columns.forEach(function (key) {
				sortOrders[key] = 1
			});
			return {
				sortKey: '',
				sortOrders: sortOrders
			}
		},
		methods: {
			sortBy: function (key) {
				this.sortKey = key;
				this.sortOrders[key] = this.sortOrders[key] * -1;
			}
		}
	});
</script>


<form action="substr_count.php" method="post">
    <label for="haystack">Enter text to analyze here.</label>
    <textarea name="haystack" id="haystack" class="form-control" rows="7"><?php if (isset($_POST['haystack'])) {
            echo $_POST['haystack'];
        } ?></textarea>
    <label for="keyword">Enter comma separated keywords to search for here.</label>
    <input name="keyword" id="keyword" type="text" class="form-control" value="<?php if (isset($_POST['keyword'])) {
        echo $_POST['keyword'];
    } ?>">
    <button type="submit">Submit</button>
</form>


<script type="text/x-template" id="keywordcounter-template">
    <table class="table table-hover">
        <thead>
        <tr>
            <th v-for="key in columns"
                style="cursor:pointer;"
                @click="sortBy(key)"
                :class="{active: sortKey == key}">
                {{key | capitalize}}
          <span class="arrow"
                :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
          </span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="
        entry in data
        | orderBy sortKey sortOrders[sortKey]">
            <td v-for="key in columns">
                {{entry[key]}}
            </td>
        </tr>
        </tbody>
    </table>
</script>

<div id="findkeywords">
    <keywordcounter
        :data="keywordcounterData"
        :columns="keywordcounterColumns">
    </keywordcounter>
</div>

<?php
if (isset($_POST['haystack']) and isset($_POST['keyword'])) {
    $haystack = $_POST['haystack'];
    $keyword = $_POST['keyword'];
 
    if (strstr($keyword, ',')) {
        $i = 1;
        $keywords = explode(',', $keyword);
        ?>
 
        <script>
            // fill the data that populates the component
            var action = new Vue({
                el: '#findkeywords',
                data: {
                    searchQuery: '',
                    keywordcounterColumns: ['term', 'count'],
                    keywordcounterData: [
                        <?php
                        foreach ($keywords as $keyword) {
                            echo ' { term: "' . $keyword . '", count: ' . substr_count($haystack, $keyword) . ' },';
                        }
                        ?>
                    ]
                }
            });
        </script>
 
    <?php
    } else {
    ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="cursor:hand;"> Term <span class="arrow asc"> </span></th>
                <th style="cursor:hand;" class="active"> Count <span class="arrow asc"> </span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $keyword ?></td>
                <td><?php echo substr_count($haystack, $keyword); ?></td>
            </tr>
            </tbody>
        </table>
        <?php
    }
}
?>