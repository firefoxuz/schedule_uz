<template>
    <div>
        <h1>Rooms</h1>
        <el-table
            v-loading="loading"
            :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
            style="width: 100%">
            <el-table-column
                label="ID"
                prop="id">
            </el-table-column>
            <el-table-column
                label="Name"
                prop="name">
            </el-table-column>
            <el-table-column
                align="right">
                <template slot="header" slot-scope="scope">
                    <el-button type="primary" size="mini" @click="openAddDialog">Add Room</el-button>
                </template>
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="openUpdateDialog(scope.$index, scope.row)">Edit
                    </el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="deleteRoom(scope.$index, scope.row)">Delete
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
            background
            layout="prev, pager, next"
            :page-size="meta.per_page"
            :current-page.sync="currentPage"
            :total="meta.total">
        </el-pagination>

        <el-dialog
            title="Room"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <span>
                <el-input placeholder="Name" v-model="dialog.name"></el-input>
            </span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="addRoom" v-if="isCreateAction">Save</el-button></span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="updateRoom"
                                                                 v-if="!isCreateAction">Update</el-button></span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    name: "room",
    data() {
        return {
            currentPage: 1,
            dialogVisible: false,
            tableData: [],
            meta: [],
            search: '',
            isCreateAction: true,
            dialog: {
                id: null,
                name: ""
            },
            loading: false
        }
    },
    mounted() {
        this.getRooms();
    },
    methods: {
        openAddDialog() {
            this.isCreateAction = true;
            this.dialogVisible = true;
        },
        openUpdateDialog(index, row){
            this.isCreateAction = false;
            this.dialogVisible = true;
            this.dialog = row
        },
        closeDialog() {
            this.dialogVisible = false;
            this.dialog = {
                id: null,
                name: ""
            }
        },
        handleClose(done) {
            this.dialog = {
                id: null,
                name: ""
            }
            done();
        },
        async getRooms() {
            this.loading = true
            await axios.get('/api/rooms?page=' + this.currentPage)
                .then((res) => {
                    this.tableData = res.data.data
                    this.meta = res.data.meta
                });
            this.loading = false
        },
        async deleteRoom(index, row) {
            let room_id = row.id
            await axios.delete("/api/rooms/" + room_id)
                .then((res) => {
                    this.getRooms()
                    this.showSuccessMessage("Room was deleted successfully")
                })
        },
        async addRoom() {
            await axios.post('/api/rooms', this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getRooms()
                    this.showSuccessMessage("Room was added successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })

        },
        async updateRoom() {
            await axios.patch('/api/rooms/' + this.dialog.id, this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getRooms()
                    this.showSuccessMessage("Room was updated successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                });
        },
        showErrorMessage(msg){
            this.$message.error(msg);
        },
        showSuccessMessage(msg){
            this.$message.success(msg)
        }
    },
    watch: {
        currentPage(newPage, oldPage) {
            this.getRooms();
        }
    },
};
</script>
